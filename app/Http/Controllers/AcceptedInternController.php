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
        $query = AcceptedIntern::with(['intern', 'creator', 'rejector']);

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
            if ($selectedStatus === 'doc_unread') {
                // Dokumen Belum Dibaca: pending + documents_verified = false
                $query->where('approval_status', 'pending')
                    ->where('documents_verified', false);
            } elseif ($selectedStatus === 'doc_read') {
                // Dokumen Telah Dibaca: pending + documents_verified = true
                $query->where('approval_status', 'pending')
                    ->where('documents_verified', true);
            } else {
                $query->where('approval_status', $selectedStatus);
            }
        }

        // Per page pagination
        $perPage = $request->get('per_page', 10);
        $acceptedInterns = $query->latest()->paginate($perPage)->withQueryString();

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

        return view('accepted-interns.index', compact('acceptedInterns', 'unitStats', 'totalInterns', 'selectedUnit', 'selectedPeriode', 'availablePeriodes', 'selectedStatus', 'perPage'));
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
     * Verify documents and send to Div Head for approval
     */
    public function verifyDocumentsAndSend(string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'pending') {
            return back()->with('error', 'Data ini sudah dikirim untuk approval sebelumnya.');
        }

        // Mark documents as verified and send to Div Head
        $acceptedIntern->update([
            'documents_verified' => true,
            'documents_verified_at' => now(),
            'documents_verified_by' => Auth::id(),
            'approval_status' => 'sent_to_divhead',
            'sent_to_divhead_at' => now(),
        ]);

        return redirect()->route('accepted-interns.index')->with('success', 'Dokumen berhasil diverifikasi dan data dikirim ke Div Head untuk approval.');
    }

    /**
     * Send to Div Head for approval (requires documents to be verified first)
     */
    public function sendToApproval(string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'pending') {
            return back()->with('error', 'Data ini sudah dikirim untuk approval sebelumnya.');
        }

        if (!$acceptedIntern->documents_verified) {
            return back()->with('error', 'Dokumen harus diverifikasi terlebih dahulu sebelum dikirim ke Div Head.');
        }

        $acceptedIntern->update([
            'approval_status' => 'sent_to_divhead',
            'sent_to_divhead_at' => now(),
        ]);

        return redirect()->route('accepted-interns.index')->with('success', 'Data berhasil dikirim ke Div Head untuk approval.');
    }

    /**
     * Reject by HC (when documents are verified but rejected)
     */
    public function rejectByHC(Request $request, string $id)
    {
        $request->validate([
            'rejection_reason' => 'required|string|max:500'
        ], [
            'rejection_reason.required' => 'Alasan penolakan harus diisi.'
        ]);

        $acceptedIntern = AcceptedIntern::with('intern')->findOrFail($id);

        if ($acceptedIntern->approval_status !== 'pending') {
            return back()->with('error', 'Data ini sudah tidak bisa ditolak.');
        }

        $acceptedIntern->update([
            'approval_status' => 'rejected',
            'rejection_reason' => $request->rejection_reason,
            'rejected_by' => Auth::id(),
            'rejected_at' => now(),
        ]);

        // Redirect to WhatsApp with rejection message
        $phone = preg_replace('/[^0-9]/', '', $acceptedIntern->intern->no_wa);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        $message = "Halo {$acceptedIntern->intern->nama},\n\n";
        $message .= "Mohon maaf, pengajuan magang Anda di PT Angkasa Pura II tidak dapat kami proses lebih lanjut.\n\n";
        $message .= "Alasan: {$request->rejection_reason}\n\n";
        $message .= "Terima kasih atas minat Anda.\n\n";
        $message .= "Salam,\nTim Human Capital";

        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect($waUrl);
    }

    /**
     * Bulk delete multiple accepted interns
     */
    public function bulkDelete(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:accepted_interns,id'
        ]);

        $count = AcceptedIntern::whereIn('id', $request->ids)->delete();

        return redirect()->route('accepted-interns.index')
            ->with('success', "{$count} data peserta magang berhasil dihapus.");
    }

    /**
     * Bulk forward to Div Head (change status from pending to sent_to_divhead)
     */
    public function bulkForwardToDivHead(Request $request)
    {
        $request->validate([
            'ids' => 'required|array',
            'ids.*' => 'exists:accepted_interns,id'
        ]);

        // Only update items that are pending and documents_verified
        $count = AcceptedIntern::whereIn('id', $request->ids)
            ->where('approval_status', 'pending')
            ->where('documents_verified', true)
            ->update(['approval_status' => 'sent_to_divhead']);

        return redirect()->route('accepted-interns.index')
            ->with('success', "{$count} data peserta magang berhasil dikirim ke Div Head untuk approval.");
    }

    /**
     * Mark a document as viewed (AJAX endpoint)
     */
    public function markDocumentViewed(Request $request, string $id)
    {
        $request->validate([
            'document' => 'required|string|in:cv,transkrip,ktp_ktm,bpjs,surat'
        ]);

        $acceptedIntern = AcceptedIntern::with('intern')->findOrFail($id);

        // Only process if status is pending and not yet verified
        if ($acceptedIntern->approval_status !== 'pending' || $acceptedIntern->documents_verified) {
            return response()->json([
                'success' => false,
                'message' => 'Documents already verified or status is not pending'
            ]);
        }

        $document = $request->document;
        $fieldName = 'viewed_' . $document;

        // Mark document as viewed
        $acceptedIntern->update([$fieldName => true]);

        // Check if all available documents are now viewed
        $intern = $acceptedIntern->intern;
        $requiredDocs = [];
        $viewedDocs = [];

        // Check which documents exist for this intern
        if ($intern->file_cv) {
            $requiredDocs[] = 'cv';
            if ($acceptedIntern->fresh()->viewed_cv)
                $viewedDocs[] = 'cv';
        }
        if ($intern->file_transkrip) {
            $requiredDocs[] = 'transkrip';
            if ($acceptedIntern->fresh()->viewed_transkrip)
                $viewedDocs[] = 'transkrip';
        }
        if ($intern->file_ktp_ktm) {
            $requiredDocs[] = 'ktp_ktm';
            if ($acceptedIntern->fresh()->viewed_ktp_ktm)
                $viewedDocs[] = 'ktp_ktm';
        }
        if ($intern->file_bpjs) {
            $requiredDocs[] = 'bpjs';
            if ($acceptedIntern->fresh()->viewed_bpjs)
                $viewedDocs[] = 'bpjs';
        }
        if ($intern->file_surat) {
            $requiredDocs[] = 'surat';
            if ($acceptedIntern->fresh()->viewed_surat)
                $viewedDocs[] = 'surat';
        }

        $allViewed = count($requiredDocs) > 0 && count($requiredDocs) === count($viewedDocs);

        // If all documents are viewed, mark as verified but DON'T send to Div Head yet
        if ($allViewed) {
            $acceptedIntern->update([
                'documents_verified' => true,
                'documents_verified_at' => now(),
                'documents_verified_by' => Auth::id(),
            ]);

            return response()->json([
                'success' => true,
                'all_viewed' => true,
                'documents_verified' => true,
                'message' => 'Semua dokumen telah dibaca. Silakan klik tombol "Kirim ke Div Head" untuk melanjutkan.'
            ]);
        }

        return response()->json([
            'success' => true,
            'all_viewed' => false,
            'viewed_count' => count($viewedDocs),
            'required_count' => count($requiredDocs),
            'remaining' => array_diff($requiredDocs, $viewedDocs)
        ]);
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

        // Per page pagination
        $perPage = $request->get('per_page', 10);
        $acceptedInterns = $query->latest()->paginate($perPage)->withQueryString();

        $totalInterns = AcceptedIntern::where('approval_status', 'approved_deputy')->count();

        // Get available periodes from approved data
        $availablePeriodes = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->select('periode_magang')
            ->distinct()
            ->whereNotNull('periode_magang')
            ->orderBy('periode_magang')
            ->pluck('periode_magang');

        // Get available units for filter dropdown
        $availableUnits = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->select('unit_magang')
            ->selectRaw('COUNT(*) as total')
            ->groupBy('unit_magang')
            ->orderBy('total', 'desc')
            ->get();

        return view('database-magang.index', compact(
            'acceptedInterns',
            'totalInterns',
            'selectedUnit',
            'selectedPeriode',
            'availablePeriodes',
            'availableUnits',
            'perPage'
        ));
    }

    /**
     * Bulk send WhatsApp surat kampus
     */
    public function bulkSendWaSuratKampus(Request $request)
    {
        $ids = $request->input('ids', []);

        if (empty($ids)) {
            return response()->json(['error' => 'Tidak ada data yang dipilih'], 400);
        }

        $acceptedInterns = AcceptedIntern::with('intern')
            ->whereIn('id', $ids)
            ->where('approval_status', 'approved_deputy')
            ->get();

        $waLinks = [];
        foreach ($acceptedInterns as $accepted) {
            $intern = $accepted->intern;
            if ($intern && $intern->no_wa) {
                $phone = preg_replace('/[^0-9]/', '', $intern->no_wa);
                if (str_starts_with($phone, '0')) {
                    $phone = '62' . substr($phone, 1);
                }

                $message = "Halo {$intern->nama}, perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\n";
                $message .= "Surat konfirmasi magang Anda sudah siap. Silakan hubungi kami untuk informasi lebih lanjut.\n\n";
                $message .= "Terima kasih.\n";
                $message .= "-Admin Pemagangan Kantor Regional I (URSHIPORTS)";

                $waLinks[] = [
                    'id' => $accepted->id,
                    'name' => $intern->nama,
                    'phone' => $phone,
                    'url' => "https://wa.me/{$phone}?text=" . urlencode($message)
                ];
            }
        }

        return response()->json(['links' => $waLinks]);
    }

    /**
     * Show Database Magang Detail
     */
    public function showDatabaseMagang($id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern', 'creator', 'approverDivHead', 'approverDeputy'])
            ->where('approval_status', 'approved_deputy')
            ->findOrFail($id);

        return view('database-magang.show', compact('acceptedIntern'));
    }

    /**
     * Edit Database Magang
     */
    public function editDatabaseMagang($id)
    {
        $acceptedIntern = AcceptedIntern::with('intern')
            ->where('approval_status', 'approved_deputy')
            ->findOrFail($id);

        return view('database-magang.edit', compact('acceptedIntern'));
    }

    /**
     * Update Database Magang
     */
    public function updateDatabaseMagang(Request $request, $id)
    {
        $acceptedIntern = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->findOrFail($id);

        $validated = $request->validate([
            'unit_magang' => 'required|string|max:255',
            'periode_magang' => 'nullable|string|max:255',
        ]);

        $acceptedIntern->update($validated);

        return redirect()->route('database-magang.show', $id)->with('success', 'Data peserta magang berhasil diupdate!');
    }

    /**
     * Delete Database Magang
     */
    public function destroyDatabaseMagang($id)
    {
        $acceptedIntern = AcceptedIntern::where('approval_status', 'approved_deputy')
            ->findOrFail($id);

        $acceptedIntern->delete();

        return redirect()->route('database-magang.index')->with('success', 'Data peserta magang berhasil dihapus!');
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

    /**
     * Mark rejection WhatsApp as sent
     */
    public function markRejectionWaSent(string $id)
    {
        $acceptedIntern = AcceptedIntern::findOrFail($id);

        if ($acceptedIntern->approval_status !== 'rejected') {
            return back()->with('error', 'Data ini tidak dalam status ditolak.');
        }

        $acceptedIntern->update([
            'rejection_wa_sent' => true
        ]);

        return back()->with('success', 'Status WhatsApp penolakan telah diupdate.');
    }
}
