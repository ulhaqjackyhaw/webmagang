<?php

namespace App\Http\Controllers;

use App\Models\AcceptedIntern;
use App\Models\Intern;
use App\Exports\AcceptedInternsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Maatwebsite\Excel\Facades\Excel;

class AcceptedInternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = AcceptedIntern::with(['intern', 'creator']);

        // Filter by unit if provided
        $selectedUnit = $request->get('unit');
        if ($selectedUnit) {
            $query->where('unit_magang', $selectedUnit);
        }

        // Filter by periode if provided
        $selectedPeriode = $request->get('periode');
        if ($selectedPeriode) {
            $query->where('periode_magang', $selectedPeriode);
        }

        // Filter by status if provided
        $selectedStatus = $request->get('status');
        if ($selectedStatus) {
            $query->where('approval_status', $selectedStatus);
        }

        $acceptedInterns = $query->latest()->get();

        // Get statistics by unit
        $unitStats = AcceptedIntern::selectRaw('unit_magang, COUNT(*) as total')
            ->groupBy('unit_magang')
            ->orderBy('total', 'desc')
            ->get();

        $totalInterns = AcceptedIntern::count();

        // Get available periodes from data
        $availablePeriodes = AcceptedIntern::select('periode_magang')
            ->distinct()
            ->whereNotNull('periode_magang')
            ->orderBy('periode_magang')
            ->pluck('periode_magang');

        return view('accepted-interns.index', compact('acceptedInterns', 'unitStats', 'totalInterns', 'selectedUnit', 'selectedPeriode', 'availablePeriodes', 'selectedStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        // Get approved interns yang belum ada di accepted_interns
        $availableInterns = Intern::where('status', 'approved')
            ->whereNotIn('id', function ($query) {
                $query->select('intern_id')->from('accepted_interns');
            })
            ->latest()
            ->get();

        return view('accepted-interns.create', compact('availableInterns'));
    }

    /**
     * Search approved interns for selection
     */
    public function search(Request $request)
    {
        $query = $request->get('q');

        $interns = Intern::where('status', 'approved')
            ->where(function ($q) use ($query) {
                $q->where('nama', 'like', "%{$query}%")
                    ->orWhere('nim', 'like', "%{$query}%")
                    ->orWhere('asal_kampus', 'like', "%{$query}%");
            })
            ->get();

        return response()->json($interns);
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'intern_id' => 'required|exists:interns,id',
            'unit_magang' => 'required|string|max:255',
        ]);

        // Get intern data for periode_magang
        $intern = \App\Models\Intern::findOrFail($validated['intern_id']);

        // Check if intern already exists in accepted_interns
        $exists = AcceptedIntern::where('intern_id', $validated['intern_id'])->exists();
        if ($exists) {
            return back()->withErrors(['intern_id' => 'Anak magang ini sudah terdaftar dalam database.'])->withInput();
        }

        // Map fields - periode taken from intern registration
        $data = [
            'intern_id' => $validated['intern_id'],
            'periode_magang' => $intern->periode_magang,
            'unit_magang' => $validated['unit_magang'],
            'created_by' => Auth::id(),
            'approval_status' => 'pending',
        ];

        AcceptedIntern::create($data);

        return redirect()->route('accepted-interns.index')->with('success', 'Data anak magang berhasil ditambahkan ke database!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern', 'creator'])->findOrFail($id);
        return view('accepted-interns.show', compact('acceptedIntern'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $acceptedIntern = AcceptedIntern::with('intern')->findOrFail($id);
        return view('accepted-interns.edit', compact('acceptedIntern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        $validated = $request->validate([
            'unit_magang' => 'required|string|max:255',
        ]);

        $acceptedIntern->update($validated);

        return redirect()->route('accepted-interns.index')->with('success', 'Data anak magang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);
        $acceptedIntern->delete();

        return redirect()->route('accepted-interns.index')->with('success', 'Data anak magang berhasil dihapus dari database!');
    }

    /**
     * Export to Excel
     */
    public function export(Request $request)
    {
        try {
            $selectedUnit = $request->get('unit');

            $query = AcceptedIntern::with('intern');

            if ($selectedUnit) {
                $query->where('unit_magang', $selectedUnit);
            }

            $acceptedInterns = $query->latest()->get();

            // Get statistics by unit
            $unitStats = AcceptedIntern::selectRaw('unit_magang, COUNT(*) as total')
                ->groupBy('unit_magang')
                ->orderBy('total', 'desc')
                ->get();

            $totalInterns = AcceptedIntern::count();

            $filename = $selectedUnit
                ? 'database-magang-' . str_replace(' ', '-', strtolower($selectedUnit)) . '.xlsx'
                : 'database-magang-semua.xlsx';

            return Excel::download(
                new AcceptedInternsExport($acceptedInterns, $unitStats, $totalInterns, $selectedUnit),
                $filename
            );
        } catch (\Exception $e) {
            return back()->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    /**
     * Send to Div Head for approval
     */
    public function sendToApproval(string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'pending') {
            return back()->with('error', 'Data ini sudah dikirim untuk approval sebelumnya.');
        }

        $acceptedIntern->update([
            'approval_status' => 'sent_to_divhead',
            'sent_to_divhead_at' => now(),
        ]);

        return back()->with('success', 'Data berhasil dikirim ke Div Head untuk approval.');
    }

    /**
     * Database Magang - Only shows fully approved interns
     */
    public function databaseMagang(Request $request)
    {
        $query = AcceptedIntern::with(['intern', 'creator', 'approverDivHead', 'approverDeputy'])
            ->where('approval_status', 'approved_deputy');

        // Filter by unit if provided
        $selectedUnit = $request->get('unit');
        if ($selectedUnit) {
            $query->where('unit_magang', $selectedUnit);
        }

        // Filter by periode if provided
        $selectedPeriode = $request->get('periode');
        if ($selectedPeriode) {
            $query->where('periode_magang', $selectedPeriode);
        }

        $acceptedInterns = $query->latest()->get();

        // Get statistics by unit (only for approved)
        $unitStats = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->selectRaw('unit_magang, COUNT(*) as total')
            ->groupBy('unit_magang')
            ->orderBy('total', 'desc')
            ->get();

        $totalInterns = AcceptedIntern::where('approval_status', 'approved_deputy')->count();

        // Get available periodes from approved data
        $availablePeriodes = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->select('periode_magang')
            ->distinct()
            ->whereNotNull('periode_magang')
            ->orderBy('periode_magang')
            ->pluck('periode_magang');

        // Get available units
        $availableUnits = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->distinct('unit_magang')
            ->pluck('unit_magang');

        return view('database-magang.index', compact(
            'acceptedInterns',
            'unitStats',
            'totalInterns',
            'selectedUnit',
            'selectedPeriode',
            'availablePeriodes',
            'availableUnits'
        ));
    }

    /**
     * Export Database Magang
     */
    public function exportDatabaseMagang(Request $request)
    {
        try {
            $selectedUnit = $request->get('unit');
            $selectedPeriode = $request->get('periode');

            $query = AcceptedIntern::with('intern')
                ->where('approval_status', 'approved_deputy');

            if ($selectedUnit) {
                $query->where('unit_magang', $selectedUnit);
            }

            if ($selectedPeriode) {
                $query->where('periode_magang', $selectedPeriode);
            }

            $acceptedInterns = $query->latest()->get();

            // Get statistics by unit
            $unitStats = AcceptedIntern::where('approval_status', 'approved_deputy')
                ->selectRaw('unit_magang, COUNT(*) as total')
                ->groupBy('unit_magang')
                ->orderBy('total', 'desc')
                ->get();

            $totalInterns = AcceptedIntern::where('approval_status', 'approved_deputy')->count();

            $filename = $selectedUnit
                ? 'database-magang-final-' . str_replace(' ', '-', strtolower($selectedUnit)) . '.xlsx'
                : 'database-magang-final-semua.xlsx';

            return Excel::download(
                new AcceptedInternsExport($acceptedInterns, $unitStats, $totalInterns, $selectedUnit),
                $filename
            );
        } catch (\Exception $e) {
            return back()->with('error', 'Error export: ' . $e->getMessage());
        }
    }

    /**
     * Generate Letter to Campus
     */
    public function generateLetter(string $id)
    {
        $acceptedIntern = AcceptedIntern::with('intern')->findOrFail($id);

        if ($acceptedIntern->approval_status !== 'approved_deputy') {
            return back()->with('error', 'Surat hanya dapat digenerate untuk data yang sudah disetujui final.');
        }

        // For now, return a view that can be printed as PDF
        return view('letters.internship', compact('acceptedIntern'));
    }
}
