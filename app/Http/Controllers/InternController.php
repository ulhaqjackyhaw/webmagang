<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Exports\InternsExport;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Facades\Excel;

class InternController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $user = Auth::user();

        $query = Intern::query();

        if ($user->role === 'tu') {
            $query->where('created_by', $user->id);
        } else {
            $query->with('creator');
        }

        // Filter by year if provided
        $selectedYear = $request->get('year');
        if ($selectedYear) {
            $query->whereYear('created_at', $selectedYear);
        }

        // Filter by month if provided
        $selectedMonth = $request->get('month');
        if ($selectedMonth) {
            $query->whereMonth('created_at', $selectedMonth);
        }

        $interns = $query->latest()->get();

        // Get available years from data
        $availableYears = Intern::selectRaw('YEAR(created_at) as year')
            ->distinct()
            ->orderBy('year', 'desc')
            ->pluck('year');

        return view('interns.index', compact('interns', 'selectedYear', 'selectedMonth', 'availableYears'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('interns.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'asal_kampus' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'email_kampus' => 'nullable|email|max:255',
            'no_wa' => 'required|string|max:20',
            'file_proposal' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $validated;
        $data['created_by'] = Auth::id();

        // Upload files
        if ($request->hasFile('file_proposal')) {
            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }
        if ($request->hasFile('file_cv')) {
            $data['file_cv'] = $request->file('file_cv')->store('cvs', 'public');
        }
        if ($request->hasFile('file_surat')) {
            $data['file_surat'] = $request->file('file_surat')->store('surats', 'public');
        }

        Intern::create($data);

        return redirect()->route('interns.index')->with('success', 'Data magang berhasil ditambahkan!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $intern = Intern::with('creator')->findOrFail($id);
        return view('interns.show', compact('intern'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $intern = Intern::findOrFail($id);

        // Only TU can edit their own data
        if (Auth::user()->role === 'tu' && $intern->created_by !== Auth::id()) {
            abort(403);
        }

        return view('interns.edit', compact('intern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        // Only TU can edit their own data
        if (Auth::user()->role === 'tu' && $intern->created_by !== Auth::id()) {
            abort(403);
        }

        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'nim' => 'required|string|max:255',
            'asal_kampus' => 'required|string|max:255',
            'program_studi' => 'required|string|max:255',
            'email_kampus' => 'nullable|email|max:255',
            'no_wa' => 'required|string|max:20',
            'file_proposal' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file_cv' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
            'file_surat' => 'nullable|file|mimes:pdf,doc,docx|max:2048',
        ]);

        $data = $validated;

        // Upload new files if provided
        if ($request->hasFile('file_proposal')) {
            if ($intern->file_proposal) {
                Storage::disk('public')->delete($intern->file_proposal);
            }
            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }
        if ($request->hasFile('file_cv')) {
            if ($intern->file_cv) {
                Storage::disk('public')->delete($intern->file_cv);
            }
            $data['file_cv'] = $request->file('file_cv')->store('cvs', 'public');
        }
        if ($request->hasFile('file_surat')) {
            if ($intern->file_surat) {
                Storage::disk('public')->delete($intern->file_surat);
            }
            $data['file_surat'] = $request->file('file_surat')->store('surats', 'public');
        }

        $intern->update($data);

        return redirect()->route('interns.index')->with('success', 'Data magang berhasil diupdate!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $intern = Intern::findOrFail($id);

        // Only TU can delete their own data or admin
        if (Auth::user()->role === 'tu' && $intern->created_by !== Auth::id()) {
            abort(403);
        }

        // Delete files
        if ($intern->file_proposal) {
            Storage::disk('public')->delete($intern->file_proposal);
        }
        if ($intern->file_cv) {
            Storage::disk('public')->delete($intern->file_cv);
        }
        if ($intern->file_surat) {
            Storage::disk('public')->delete($intern->file_surat);
        }

        $intern->delete();

        return redirect()->route('interns.index')->with('success', 'Data magang berhasil dihapus!');
    }

    /**
     * Update status (for HC role)
     */
    public function updateStatus(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:approved,rejected',
            'rejection_reason' => 'required_if:status,rejected|nullable|string|max:500'
        ], [
            'rejection_reason.required_if' => 'Alasan penolakan wajib diisi saat menolak data.'
        ]);

        $intern->update([
            'status' => $validated['status'],
            'rejection_reason' => $validated['status'] === 'rejected' ? $validated['rejection_reason'] : null
        ]);

        // Format phone number
        $phone = preg_replace('/[^0-9]/', '', $intern->no_wa);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        if ($validated['status'] === 'approved') {
            // Redirect to WhatsApp for approved
            $message = "Halo {$intern->nama}, perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";
            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            return redirect($waUrl);
        } else {
            // Redirect to WhatsApp for rejected
            $message = "Halo {$intern->nama}, mohon maaf pengajuan magang Anda ditolak.\n\nAlasan: {$validated['rejection_reason']}\n\nAnda dapat mengajukan kembali setelah memperbaiki kekurangan yang ada. Terima kasih.";
            $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

            return redirect($waUrl);
        }
    }

    /**
     * Export to Excel
     */
    public function export(Request $request)
    {
        try {
            $status = $request->get('status', 'all');

            $query = Intern::query();

            if ($status !== 'all') {
                $query->where('status', $status);
            }

            $interns = $query->get();

            return Excel::download(new InternsExport($interns), 'data-magang-' . $status . '.xlsx');
        } catch (\Exception $e) {
            return back()->with('error', 'Error export: ' . $e->getMessage());
        }
    }
}
