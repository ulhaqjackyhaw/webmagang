<?php

namespace App\Http\Controllers;

use App\Models\AcceptedIntern;
use Illuminate\Http\Request;
use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\IOFactory;
use PhpOffice\PhpWord\SimpleType\Jc;
use Carbon\Carbon;

class AdministrasiPersuratanController extends Controller
{
    /**
     * Display a listing of approved interns for administration
     */
    public function index(Request $request)
    {
        $query = AcceptedIntern::with(['intern', 'intern.creator'])
            ->where('approval_status', 'approved_deputy');

        // Filter by status
        $filterStatus = $request->get('status');
        if ($filterStatus === 'incomplete') {
            $query->where(function ($q) {
                $q->where('surat_konfirmasi_unit_downloaded', false)
                    ->orWhere('surat_ke_kampus_downloaded', false)
                    ->orWhere('wa_onboarding_sent', false);
            });
        } elseif ($filterStatus === 'complete') {
            $query->where('surat_konfirmasi_unit_downloaded', true)
                ->where('surat_ke_kampus_downloaded', true)
                ->where('wa_onboarding_sent', true);
        }

        // Search by name
        if ($request->filled('search')) {
            $search = $request->get('search');
            $query->whereHas('intern', function ($q) use ($search) {
                $q->where('nama', 'like', "%{$search}%")
                    ->orWhere('nim', 'like', "%{$search}%")
                    ->orWhere('asal_kampus', 'like', "%{$search}%");
            });
        }

        $perPage = $request->get('per_page', 10);
        $acceptedInterns = $query->orderBy('created_at', 'desc')->paginate($perPage)->withQueryString();

        return view('administrasi-persuratan.index', compact('acceptedInterns', 'filterStatus', 'perPage'));
    }

    /**
     * Download Surat Konfirmasi Unit (Word)
     */
    public function downloadSuratKonfirmasiUnit($id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern'])->findOrFail($id);
        $intern = $acceptedIntern->intern;

        // Create Word document
        $phpWord = new PhpWord();

        // Set default font
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection([
            'marginLeft' => 1418,  // 2.5 cm in twips
            'marginRight' => 1418,
            'marginTop' => 1418,
            'marginBottom' => 1418,
        ]);

        // Header - Kop Surat (simplified)
        $section->addText('INJOURNEY AIRPORTS', ['bold' => true, 'size' => 14], ['alignment' => Jc::CENTER]);
        $section->addText('KANTOR REGIONAL I', ['bold' => true, 'size' => 12], ['alignment' => Jc::CENTER]);
        $section->addTextBreak(2);

        // Document Title
        $section->addText('SURAT KONFIRMASI PENEMPATAN UNIT', ['bold' => true, 'size' => 14, 'underline' => 'single'], ['alignment' => Jc::CENTER]);
        $section->addTextBreak(2);

        // Document Body
        $section->addText('Dengan hormat,', [], ['alignment' => Jc::BOTH]);
        $section->addTextBreak(1);

        $section->addText(
            'Berdasarkan hasil seleksi dan persetujuan, dengan ini kami mengkonfirmasi bahwa:',
            [],
            ['alignment' => Jc::BOTH]
        );
        $section->addTextBreak(1);

        // Intern details
        $section->addText('Nama : ' . $intern->nama);
        $section->addText('NIM : ' . $intern->nim);
        $section->addText('Asal Kampus : ' . $intern->asal_kampus);
        $section->addText('Program Studi : ' . $intern->program_studi);
        $section->addText('Unit Penempatan : ' . ($acceptedIntern->unit_magang ?? '-'));

        // Use dates from acceptedIntern if available, otherwise from intern
        $tanggalMulai = $acceptedIntern->tanggal_mulai ?? $intern->tanggal_mulai_magang;
        $tanggalSelesai = $acceptedIntern->tanggal_selesai ?? $intern->tanggal_selesai_magang;

        $section->addText('Tanggal Mulai : ' . ($tanggalMulai ? Carbon::parse($tanggalMulai)->format('d F Y') : '-'));
        $section->addText('Tanggal Selesai : ' . ($tanggalSelesai ? Carbon::parse($tanggalSelesai)->format('d F Y') : '-'));
        $section->addTextBreak(1);

        $section->addText(
            'telah diterima sebagai peserta Magang/PKL di lingkungan Injourney Airports Kantor Regional I.',
            [],
            ['alignment' => Jc::BOTH]
        );
        $section->addTextBreak(2);

        // Signature
        $section->addText('Hormat kami,', [], ['alignment' => Jc::RIGHT]);
        $section->addTextBreak(3);
        $section->addText('Human Capital', ['bold' => true], ['alignment' => Jc::RIGHT]);

        // Mark as downloaded
        $acceptedIntern->update(['surat_konfirmasi_unit_downloaded' => true]);

        // Generate and download
        $fileName = 'Surat_Konfirmasi_Unit_' . str_replace(' ', '_', $intern->nama) . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'konfirmasi');

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Download Surat ke Kampus (Word)
     */
    public function downloadSuratKeKampus($id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern'])->findOrFail($id);
        $intern = $acceptedIntern->intern;

        // Create Word document
        $phpWord = new PhpWord();

        // Set default font
        $phpWord->setDefaultFontName('Times New Roman');
        $phpWord->setDefaultFontSize(12);

        $section = $phpWord->addSection([
            'marginLeft' => 1418,
            'marginRight' => 1418,
            'marginTop' => 1418,
            'marginBottom' => 1418,
        ]);

        // Header - Kop Surat
        $section->addText('INJOURNEY AIRPORTS', ['bold' => true, 'size' => 14], ['alignment' => Jc::CENTER]);
        $section->addText('KANTOR REGIONAL I', ['bold' => true, 'size' => 12], ['alignment' => Jc::CENTER]);
        $section->addTextBreak(2);

        // Document info
        $section->addText('Nomor : ...../...../' . date('Y'));
        $section->addText('Lampiran : -');
        $section->addText('Perihal : Balasan Permohonan Magang/PKL');
        $section->addTextBreak(1);

        // Recipient
        $section->addText('Kepada Yth.');
        $section->addText($intern->pengirim_surat ?? 'Pimpinan');
        $section->addText($intern->asal_kampus);
        $section->addText('di Tempat');
        $section->addTextBreak(1);

        // Document Body
        $section->addText('Dengan hormat,', [], ['alignment' => Jc::BOTH]);
        $section->addTextBreak(1);

        $section->addText(
            'Menindaklanjuti surat dari ' . $intern->asal_kampus . ' Nomor: ' . ($intern->nomor_surat_kampus ?? '-') .
            ' tanggal ' . ($intern->tanggal_surat ? Carbon::parse($intern->tanggal_surat)->format('d F Y') : '-') .
            ' perihal ' . ($intern->perihal_surat ?? 'Permohonan Magang/PKL') . ', dengan ini kami sampaikan bahwa:',
            [],
            ['alignment' => Jc::BOTH]
        );
        $section->addTextBreak(1);

        // Intern details
        $section->addText('Nama : ' . $intern->nama);
        $section->addText('NIM : ' . $intern->nim);
        $section->addText('Program Studi : ' . $intern->program_studi);
        $section->addTextBreak(1);

        $section->addText(
            'dapat diterima untuk melaksanakan Magang/PKL di lingkungan Injourney Airports Kantor Regional I dengan ketentuan sebagai berikut:',
            [],
            ['alignment' => Jc::BOTH]
        );
        $section->addTextBreak(1);

        // Use dates from acceptedIntern if available, otherwise from intern
        $tanggalMulai = $acceptedIntern->tanggal_mulai ?? $intern->tanggal_mulai_magang;
        $tanggalSelesai = $acceptedIntern->tanggal_selesai ?? $intern->tanggal_selesai_magang;

        $section->addText('1. Unit Penempatan : ' . ($acceptedIntern->unit_magang ?? '-'));
        $section->addText('2. Periode : ' . ($tanggalMulai ? Carbon::parse($tanggalMulai)->format('d F Y') : '-') . ' s.d. ' . ($tanggalSelesai ? Carbon::parse($tanggalSelesai)->format('d F Y') : '-'));
        $section->addTextBreak(1);

        $section->addText('Demikian surat ini kami sampaikan, atas perhatian dan kerjasamanya diucapkan terima kasih.', [], ['alignment' => Jc::BOTH]);
        $section->addTextBreak(2);

        // Signature
        $section->addText('Hormat kami,', [], ['alignment' => Jc::RIGHT]);
        $section->addTextBreak(3);
        $section->addText('Human Capital', ['bold' => true], ['alignment' => Jc::RIGHT]);

        // Mark as downloaded
        $acceptedIntern->update(['surat_ke_kampus_downloaded' => true]);

        // Generate and download
        $fileName = 'Surat_Ke_Kampus_' . str_replace(' ', '_', $intern->nama) . '.docx';
        $tempFile = tempnam(sys_get_temp_dir(), 'kampus');

        $objWriter = IOFactory::createWriter($phpWord, 'Word2007');
        $objWriter->save($tempFile);

        return response()->download($tempFile, $fileName)->deleteFileAfterSend(true);
    }

    /**
     * Send WhatsApp onboarding information
     */
    public function sendWhatsAppOnboarding($id)
    {
        $acceptedIntern = AcceptedIntern::with(['intern'])->findOrFail($id);
        $intern = $acceptedIntern->intern;

        // Mark as sent
        $acceptedIntern->update(['wa_onboarding_sent' => true]);

        // Format phone number
        $phone = preg_replace('/[^0-9]/', '', $intern->no_wa);
        if (substr($phone, 0, 1) === '0') {
            $phone = '62' . substr($phone, 1);
        }

        // Use dates from acceptedIntern if available, otherwise from intern
        $tanggalMulai = $acceptedIntern->tanggal_mulai ?? $intern->tanggal_mulai_magang;
        $tanggalSelesai = $acceptedIntern->tanggal_selesai ?? $intern->tanggal_selesai_magang;

        // Build WhatsApp message
        $message = "Kepada Yth.\n";
        $message .= "*{$intern->nama}*\n\n";
        $message .= "Dengan hormat,\n\n";
        $message .= "Selamat! Anda telah diterima sebagai peserta Magang/PKL di Injourney Airports Kantor Regional I.\n\n";
        $message .= "*Detail Penempatan:*\n";
        $message .= "📍 Unit: " . ($acceptedIntern->unit_magang ?? '-') . "\n";
        $message .= "📅 Periode: " . ($tanggalMulai ? Carbon::parse($tanggalMulai)->format('d M Y') : '-') . " s.d. " . ($tanggalSelesai ? Carbon::parse($tanggalSelesai)->format('d M Y') : '-') . "\n\n";
        $message .= "*Informasi Onboarding:*\n";
        $message .= "1. Harap hadir pada hari pertama magang pukul 07.30 WIB\n";
        $message .= "2. Siapkan dokumen asli (KTP, KTM, BPJS)\n";
        $message .= "3. Kenakan pakaian formal (kemeja/blouse)\n";
        $message .= "4. Lapor ke bagian Human Capital\n\n";
        $message .= "Atas perhatiannya diucapkan terima kasih.\n\n";
        $message .= "Salam,\n";
        $message .= "*Human Capital*\n";
        $message .= "*Injourney Airports Kantor Regional I*";

        $waUrl = 'https://wa.me/' . $phone . '?text=' . urlencode($message);

        return redirect($waUrl);
    }

    /**
     * Bulk download Surat Konfirmasi Unit
     */
    public function bulkDownloadSuratKonfirmasi(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu data.');
        }

        // For bulk, we'll mark all as downloaded and redirect to first one
        // In a real scenario, you might want to create a ZIP file
        AcceptedIntern::whereIn('id', $ids)->update(['surat_konfirmasi_unit_downloaded' => true]);

        return back()->with('success', count($ids) . ' surat konfirmasi unit telah ditandai sebagai diunduh.');
    }

    /**
     * Bulk download Surat ke Kampus
     */
    public function bulkDownloadSuratKampus(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu data.');
        }

        AcceptedIntern::whereIn('id', $ids)->update(['surat_ke_kampus_downloaded' => true]);

        return back()->with('success', count($ids) . ' surat ke kampus telah ditandai sebagai diunduh.');
    }

    /**
     * Bulk send WhatsApp onboarding
     */
    public function bulkSendWhatsApp(Request $request)
    {
        $ids = $request->input('ids', []);
        if (empty($ids)) {
            return back()->with('error', 'Pilih minimal satu data.');
        }

        AcceptedIntern::whereIn('id', $ids)->update(['wa_onboarding_sent' => true]);

        return back()->with('success', count($ids) . ' peserta telah ditandai WhatsApp onboarding terkirim.');
    }
}
