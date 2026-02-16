<?php

namespace App\Http\Controllers;

use App\Models\FormulirTemplate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;

class FormulirTemplateController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $formulirs = FormulirTemplate::with('uploader')->latest()->get();
        return view('formulir-templates.index', compact('formulirs'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('formulir-templates.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_formulir' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'required|file|mimes:pdf,doc,docx|max:5120',
            'is_active' => 'nullable|boolean',
        ], [
            'nama_formulir.required' => 'Nama formulir wajib diisi.',
            'file.required' => 'File formulir wajib diupload.',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $data = $validated;
        $data['uploaded_by'] = Auth::id();
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Upload file
        if ($request->hasFile('file')) {
            $data['file_path'] = $request->file('file')->store('formulir-templates', 'public');
        }

        unset($data['file']);

        FormulirTemplate::create($data);

        return redirect()->route('formulir-templates.index')
            ->with('success', 'Formulir berhasil ditambahkan.');
    }

    /**
     * Display the specified resource.
     */
    public function show(FormulirTemplate $formulirTemplate)
    {
        // Get file extension from original file path
        $extension = pathinfo($formulirTemplate->file_path, PATHINFO_EXTENSION);
        $fileName = $formulirTemplate->nama_formulir . '.' . $extension;

        return Storage::disk('public')->download($formulirTemplate->file_path, $fileName);
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(FormulirTemplate $formulirTemplate)
    {
        return view('formulir-templates.edit', compact('formulirTemplate'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, FormulirTemplate $formulirTemplate)
    {
        $validated = $request->validate([
            'nama_formulir' => 'required|string|max:255',
            'deskripsi' => 'nullable|string',
            'file' => 'nullable|file|mimes:pdf,doc,docx|max:5120',
            'is_active' => 'nullable|boolean',
        ], [
            'nama_formulir.required' => 'Nama formulir wajib diisi.',
            'file.mimes' => 'File harus berformat PDF, DOC, atau DOCX.',
            'file.max' => 'Ukuran file maksimal 5MB.',
        ]);

        $data = $validated;
        $data['is_active'] = $request->has('is_active') ? true : false;

        // Upload new file if provided
        if ($request->hasFile('file')) {
            // Delete old file
            if ($formulirTemplate->file_path) {
                Storage::disk('public')->delete($formulirTemplate->file_path);
            }
            $data['file_path'] = $request->file('file')->store('formulir-templates', 'public');
        }

        unset($data['file']);

        $formulirTemplate->update($data);

        return redirect()->route('formulir-templates.index')
            ->with('success', 'Formulir berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(FormulirTemplate $formulirTemplate)
    {
        // Delete file from storage
        if ($formulirTemplate->file_path) {
            Storage::disk('public')->delete($formulirTemplate->file_path);
        }

        $formulirTemplate->delete();

        return redirect()->route('formulir-templates.index')
            ->with('success', 'Formulir berhasil dihapus.');
    }
}
