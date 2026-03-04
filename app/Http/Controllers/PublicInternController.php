<?php

namespace App\Http\Controllers;

use App\Models\Intern;
use App\Models\PeriodeMagang;
// use App\Models\FormulirTemplate; // Dihilangkan - formulir tidak digunakan
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PublicInternController extends Controller
{
    /**
     * Show landing page
     */
    public function index()
    {
        return view('public.landing');
    }

    /**
     * Show registration form
     */
    public function create()
    {
        // $formulirs = FormulirTemplate::where('is_active', true)->latest()->get(); // Dihilangkan - formulir tidak digunakan
        $universities = $this->getUniversitiesFromCsv();

        // Get open periods grouped by batch
        $periodes = PeriodeMagang::openForRegistration()
            ->orderBy('nama_batch')
            ->orderBy('tanggal_mulai')
            ->get()
            ->groupBy('nama_batch');

        return view('public.register', compact('universities', 'periodes'));
    }

    /**
     * Load universities from CSV file
     */
    private function getUniversitiesFromCsv()
    {
        $universities = [];
        $csvPath = base_path('perguruan-tinggi.csv');

        if (file_exists($csvPath)) {
            $file = fopen($csvPath, 'r');

            // Skip header row
            fgetcsv($file);

            // Read each row
            while (($row = fgetcsv($file)) !== false) {
                if (isset($row[1]) && !empty(trim($row[1]))) {
                    $universities[] = trim($row[1]);
                }
            }

            fclose($file);

            // Sort alphabetically and remove duplicates
            $universities = array_unique($universities);
            sort($universities);
        }

        return $universities;
    }

    /**
     * Store intern application from public
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama' => 'required|string|max:255',
            'jenis_kelamin' => 'required|in:Laki-laki,Perempuan',
            'periode_magang' => 'required|string|max:100',
            'nim' => 'required|string|max:255',
            'asal_kampus' => 'required|string|max:255',
            'kampus_lainnya' => 'required_if:asal_kampus,Lainnya|nullable|string|max:255',
            'program_studi' => 'required|string|max:255',
            'kelas' => 'nullable|string|max:50',
            'semester' => 'required|string|max:10',
            'tujuan_magang' => 'required|string|in:Mata Kuliah Magang,Praktik Kerja Lapangan,Lainnya',
            'email_kampus' => 'nullable|email|max:255',
            'no_wa' => 'required|string|max:20',
            // File uploads - 4 files + surat
            'file_cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_transkrip' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_ktp_ktm' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_bpjs' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
            // Keterangan surat magang
            'nomor_surat_kampus' => 'required|string|max:100',
            'tanggal_surat' => 'required|date',
            'perihal_surat' => 'required|string|max:255',
            'pengirim_surat' => 'required|string|max:255',
            // Tanggal magang dalam periode
            'tanggal_mulai_magang' => 'required|date',
            'tanggal_selesai_magang' => 'required|date|after:tanggal_mulai_magang',
            // Persetujuan
            'persetujuan_sehat' => 'required|accepted',
            'persetujuan_penempatan' => 'required|accepted',
            'persetujuan_data' => 'required|accepted',
        ], [
            'nama.required' => 'Nama wajib diisi.',
            'jenis_kelamin.required' => 'Jenis kelamin wajib dipilih.',
            'jenis_kelamin.in' => 'Jenis kelamin tidak valid.',
            'periode_magang.required' => 'Periode magang wajib dipilih.',
            'nim.required' => 'NIM wajib diisi.',
            'asal_kampus.required' => 'Asal kampus wajib diisi.',
            'kampus_lainnya.required_if' => 'Nama kampus wajib diisi jika memilih Lainnya.',
            'program_studi.required' => 'Program studi wajib diisi.',
            'semester.required' => 'Semester wajib dipilih.',
            'tujuan_magang.required' => 'Tujuan magang wajib dipilih.',
            'tujuan_magang.in' => 'Tujuan magang tidak valid.',
            'email_kampus.email' => 'Format email tidak valid',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            // File validation messages
            'file_cv.required' => 'File CV wajib diupload.',
            'file_cv.mimes' => 'File CV harus berformat PDF, DOC, atau DOCX.',
            'file_cv.max' => 'Ukuran file CV maksimal 2MB.',
            'file_transkrip.required' => 'File transkrip nilai wajib diupload.',
            'file_transkrip.mimes' => 'File transkrip harus berformat PDF, DOC, atau DOCX.',
            'file_transkrip.max' => 'Ukuran file transkrip maksimal 2MB.',
            'file_ktp_ktm.required' => 'File KTP dan KTM/Kartu Pelajar wajib diupload.',
            'file_ktp_ktm.mimes' => 'File KTP/KTM harus berformat PDF, DOC, atau DOCX.',
            'file_ktp_ktm.max' => 'Ukuran file KTP/KTM maksimal 2MB.',
            'file_bpjs.required' => 'File BPJS Kesehatan wajib diupload.',
            'file_bpjs.mimes' => 'File BPJS harus berformat PDF, DOC, atau DOCX.',
            'file_bpjs.max' => 'Ukuran file BPJS maksimal 2MB.',
            'file_surat.required' => 'File surat permohonan wajib diupload.',
            'file_surat.mimes' => 'File surat permohonan harus berformat PDF, DOC, atau DOCX.',
            'file_surat.max' => 'Ukuran file surat permohonan maksimal 2MB.',
            // Keterangan surat validation messages
            'nomor_surat_kampus.required' => 'Nomor surat magang kampus wajib diisi.',
            'tanggal_surat.required' => 'Tanggal surat wajib diisi.',
            'perihal_surat.required' => 'Perihal surat wajib diisi.',
            'pengirim_surat.required' => 'Pengirim/penandatangan surat wajib diisi.',
            // Tanggal magang validation messages
            'tanggal_mulai_magang.required' => 'Tanggal mulai magang wajib diisi.',
            'tanggal_selesai_magang.required' => 'Tanggal selesai magang wajib diisi.',
            'tanggal_selesai_magang.after' => 'Tanggal selesai harus setelah tanggal mulai.',
            // Persetujuan messages
            'persetujuan_sehat.accepted' => 'Anda harus menyetujui pernyataan sehat jasmani dan rohani.',
            'persetujuan_penempatan.accepted' => 'Anda harus menyetujui kesediaan penempatan di unit kerja.',
            'persetujuan_data.accepted' => 'Anda harus menyetujui kebenaran data yang diberikan.',
        ]);

        $data = $validated;
        $data['created_by'] = null; // Public registration, no user logged in

        // Convert text fields to uppercase
        $uppercaseFields = ['nama', 'nim', 'program_studi', 'kelas', 'email_kampus', 'asal_kampus', 'nomor_surat_kampus', 'perihal_surat', 'pengirim_surat'];
        foreach ($uppercaseFields as $field) {
            if (isset($data[$field])) {
                $data[$field] = strtoupper($data[$field]);
            }
        }

        // Handle "Lainnya" selection - use custom kampus name
        if ($request->asal_kampus === 'Lainnya' && $request->kampus_lainnya) {
            $data['asal_kampus'] = strtoupper($request->kampus_lainnya);
        }

        // Upload files
        if ($request->hasFile('file_cv')) {
            $data['file_cv'] = $request->file('file_cv')->store('cvs', 'public');
        }
        if ($request->hasFile('file_transkrip')) {
            $data['file_transkrip'] = $request->file('file_transkrip')->store('transkrips', 'public');
        }
        if ($request->hasFile('file_ktp_ktm')) {
            $data['file_ktp_ktm'] = $request->file('file_ktp_ktm')->store('ktp_ktms', 'public');
        }
        if ($request->hasFile('file_bpjs')) {
            $data['file_bpjs'] = $request->file('file_bpjs')->store('bpjs', 'public');
        }
        if ($request->hasFile('file_surat')) {
            $data['file_surat'] = $request->file('file_surat')->store('surats', 'public');
        }

        // Remove checkbox values and kampus_lainnya before saving
        unset($data['persetujuan_sehat'], $data['persetujuan_penempatan'], $data['persetujuan_data'], $data['kampus_lainnya']);

        Intern::create($data);

        return redirect()->route('public.success')->with('success', 'Pendaftaran magang berhasil! Tim kami akan menghubungi Anda segera.');
    }

    /**
     * Show success page
     */
    public function success()
    {
        return view('public.success');
    }

    /**
     * Download formulir template (public access)
     * Dihilangkan - formulir tidak digunakan
     */
    // public function downloadFormulir($id)
    // {
    //     $formulir = FormulirTemplate::findOrFail($id);

    //     // Only allow download if formulir is active
    //     if (!$formulir->is_active) {
    //         abort(404);
    //     }

    //     // Get file extension from original file path
    //     $extension = pathinfo($formulir->file_path, PATHINFO_EXTENSION);
    //     $fileName = $formulir->nama_formulir . '.' . $extension;

    //     return Storage::disk('public')->download($formulir->file_path, $fileName);
    // }
}
