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

        // Filter by year if provided
        $selectedYear = $request->get('year');
        if ($selectedYear) {
            $query->whereYear('periode_awal', $selectedYear);
        }

        // Filter by month if provided
        $selectedMonth = $request->get('month');
        if ($selectedMonth) {
            $query->whereMonth('periode_awal', $selectedMonth);
        }

        $acceptedInterns = $query->latest()->get();

        // Get statistics by unit
        $unitStats = AcceptedIntern::selectRaw('unit_magang, COUNT(*) as total')
            ->groupBy('unit_magang')
            ->orderBy('total', 'desc')
            ->get();

        $totalInterns = AcceptedIntern::count();

        // Get available years from data
        $availableYears = AcceptedIntern::selectRaw('YEAR(periode_awal) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('accepted-interns.index', compact('acceptedInterns', 'unitStats', 'totalInterns', 'selectedUnit', 'selectedYear', 'selectedMonth', 'availableYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('accepted-interns.create');
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
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after:periode_awal',
            'unit_magang' => 'required|string|max:255',
        ], [
            'periode_akhir.after' => 'Periode akhir harus setelah periode awal.',
        ]);

        // Check if intern already exists in accepted_interns
        $exists = AcceptedIntern::where('intern_id', $validated['intern_id'])->exists();
        if ($exists) {
            return back()->withErrors(['intern_id' => 'Anak magang ini sudah terdaftar dalam database.'])->withInput();
        }

        $validated['created_by'] = Auth::id();

        AcceptedIntern::create($validated);

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
            'periode_awal' => 'required|date',
            'periode_akhir' => 'required|date|after:periode_awal',
            'unit_magang' => 'required|string|max:255',
        ], [
            'periode_akhir.after' => 'Periode akhir harus setelah periode awal.',
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
}
