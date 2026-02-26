<?php

namespace App\Http\Controllers;

use App\Models\Intern;
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
        return view('public.register', compact('universities'));
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
            'email_kampus' => 'nullable|email|max:255',
            'no_wa' => 'required|string|max:20',
            // 'file_formulir' => 'required|file|mimes:pdf,doc,docx|max:2048', // Dihilangkan - formulir tidak digunakan
            'file_proposal' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_cv' => 'required|file|mimes:pdf,doc,docx|max:2048',
            'file_surat' => 'required|file|mimes:pdf,doc,docx|max:2048',
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
            'email_kampus.email' => 'Format email tidak valid.',
            'no_wa.required' => 'Nomor WhatsApp wajib diisi.',
            // Dihilangkan - formulir tidak digunakan
            // 'file_formulir.required' => 'File formulir pendaftaran wajib diupload.',
            // 'file_formulir.mimes' => 'File formulir harus berformat PDF, DOC, atau DOCX.',
            // 'file_formulir.max' => 'Ukuran file formulir maksimal 2MB.',
            'file_proposal.required' => 'File proposal wajib diupload.',
            'file_proposal.mimes' => 'File proposal harus berformat PDF, DOC, atau DOCX.',
            'file_proposal.max' => 'Ukuran file proposal maksimal 2MB.',
            'file_cv.required' => 'File CV wajib diupload.',
            'file_cv.mimes' => 'File CV harus berformat PDF, DOC, atau DOCX.',
            'file_cv.max' => 'Ukuran file CV maksimal 2MB.',
            'file_surat.required' => 'File surat permohonan wajib diupload.',
            'file_surat.mimes' => 'File surat permohonan harus berformat PDF, DOC, atau DOCX.',
            'file_surat.max' => 'Ukuran file surat permohonan maksimal 2MB.',
            'persetujuan_sehat.accepted' => 'Anda harus menyetujui pernyataan sehat jasmani dan rohani.',
            'persetujuan_penempatan.accepted' => 'Anda harus menyetujui kesediaan penempatan di unit kerja.',
            'persetujuan_data.accepted' => 'Anda harus menyetujui kebenaran data yang diberikan.',
        ]);

        $data = $validated;
        $data['created_by'] = null; // Public registration, no user logged in

        // Convert text fields to uppercase
        $uppercaseFields = ['nama', 'nim', 'program_studi', 'email_kampus', 'asal_kampus'];
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
        // Dihilangkan - formulir tidak digunakan
        // if ($request->hasFile('file_formulir')) {
        //     $data['file_formulir'] = $request->file('file_formulir')->store('formulirs', 'public');
        // }
        if ($request->hasFile('file_proposal')) {
            $data['file_proposal'] = $request->file('file_proposal')->store('proposals', 'public');
        }
        if ($request->hasFile('file_cv')) {
            $data['file_cv'] = $request->file('file_cv')->store('cvs', 'public');
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
