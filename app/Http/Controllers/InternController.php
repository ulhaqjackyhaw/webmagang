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
        // Only HC and Admin can access - show all interns with creator info
        $query = Intern::with('creator');

        // Filter by periode if provided
        $selectedPeriode = $request->get('periode');
        if ($selectedPeriode) {
            $query->where('periode_magang', $selectedPeriode);
        }

        $interns = $query->latest()->get();

        // Get available periodes from data
        $availablePeriodes = Intern::select('periode_magang')
            ->distinct()
            ->whereNotNull('periode_magang')
            ->orderBy('periode_magang')
            ->pluck('periode_magang');

        return view('interns.index', compact('interns', 'selectedPeriode', 'availablePeriodes'));
    }

    /**
     * Create and Store methods removed - registration is now only via public form
     * @see PublicInternController for public registration
     */

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

        // Only HC and Admin can edit
        return view('interns.edit', compact('intern'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        // Only HC and Admin can edit

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

        // Only HC and Admin can delete

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
     * Update status (for HC role) - Just reject, no WhatsApp
     */
    public function updateStatus(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        $validated = $request->validate([
            'status' => 'required|in:rejected',
            'rejection_reason' => 'required|string|max:500'
        ], [
            'rejection_reason.required' => 'Alasan penolakan wajib diisi saat menolak data.'
        ]);

        $intern->update([
            'status' => 'rejected',
            'rejection_reason' => $validated['rejection_reason']
        ]);

        return redirect()->route('interns.index')->with('success', 'Pengajuan magang telah ditolak.');
    }

    /**
     * Accept intern and create AcceptedIntern entry
     */
    public function acceptIntern(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        // Validate input - only unit_magang, periode already from registration
        $validated = $request->validate([
            'unit_magang' => 'required|string|max:255',
        ]);

        // Check if intern already exists in accepted_interns
        $exists = \App\Models\AcceptedIntern::where('intern_id', $intern->id)->exists();
        if ($exists) {
            return back()->withErrors(['error' => 'Anak magang ini sudah diproses sebelumnya.'])->withInput();
        }

        // Create AcceptedIntern entry - automatically sent to Div Head
        // Periode taken from intern registration data
        \App\Models\AcceptedIntern::create([
            'intern_id' => $intern->id,
            'periode_magang' => $intern->periode_magang,
            'unit_magang' => $validated['unit_magang'],
            'created_by' => Auth::id(),
            'approval_status' => 'sent_to_divhead', // Automatically sent to Div Head
            'sent_to_divhead_at' => now(),
        ]);

        // Update intern status to approved (accepted by HC)
        $intern->update(['status' => 'approved']);

        return redirect()->route('accepted-interns.index')->with('success', 'Pengajuan magang diterima dan sudah diteruskan ke Div Head untuk persetujuan.');
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

    /**
     * Mark document as checked
     */
    public function markDocumentChecked(string $id)
    {
        $intern = Intern::findOrFail($id);

        $intern->update([
            'document_checked' => true,
            'document_checked_at' => now(),
        ]);

        return back()->with('success', 'Dokumen telah ditandai sebagai sudah dicek.');
    }

    /**
     * Send WhatsApp message to intern
     */
    public function sendWhatsApp(Request $request, string $id)
    {
        $intern = Intern::findOrFail($id);

        $type = $request->get('type', 'custom');

        // Format phone number
        $phone = preg_replace('/[^0-9]/', '', $intern->no_wa);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Build message based on type
        switch ($type) {
            case 'received':
                $message = "Halo {$intern->nama}, perkenalkan saya PIC Magang Unit Learning Management Kantor Regional I\n\nSaat ini berkas pengajuan kamu sudah kami terima dan sedang diproses sesuai dengan ketentuan dan kebutuhan perusahaan. Untuk informasinya selanjutnya akan diberitahukan di kesempatan berikutnya.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS; Your Internship Programme at Injourney Airports Kantor Regional I)";
                break;
            case 'approved':
                $message = "Halo {$intern->nama}, selamat! Pengajuan magang Anda telah DISETUJUI.\n\nSilakan menunggu informasi lebih lanjut mengenai penempatan unit dan jadwal magang Anda.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS)";
                break;
            case 'rejected':
                $message = "Halo {$intern->nama}, mohon maaf pengajuan magang Anda TIDAK DAPAT kami terima saat ini.\n\n" . ($intern->rejection_reason ? "Alasan: {$intern->rejection_reason}\n\n" : "") . "Anda dapat mengajukan kembali setelah memenuhi persyaratan yang ada.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS)";
                break;
            case 'placement':
                $acceptedIntern = $intern->acceptedIntern;
                $unit = $acceptedIntern ? $acceptedIntern->unit_magang : '[Unit Magang]';
                $periode = $acceptedIntern ? ($acceptedIntern->periode_magang ?? $intern->periode_magang) : ($intern->periode_magang ?? '[Periode Magang]');
                $message = "Halo {$intern->nama}, berikut informasi penempatan magang Anda:\n\nUnit Magang: {$unit}\nPeriode: {$periode}\n\nSilakan hadir sesuai jadwal yang telah ditentukan.\n\nTerima kasih.\n-Admin Pemagangan Kantor Regional I (URSHIPORTS)";
                break;
            default:
                $message = $request->get('message', "Halo {$intern->nama}, ");
                break;
        }

        $waUrl = "https://wa.me/{$phone}?text=" . urlencode($message);

        return redirect($waUrl);
    }
}
