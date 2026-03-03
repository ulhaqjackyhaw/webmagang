<?php

namespace App\Http\Controllers;

use App\Models\PeriodeMagang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PeriodeMagangController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(Request $request)
    {
        $query = PeriodeMagang::with('creator');

        // Filter by status if provided
        $filterStatus = $request->get('status');
        if ($filterStatus === 'active') {
            $query->where('is_active', true);
        } elseif ($filterStatus === 'inactive') {
            $query->where('is_active', false);
        }

        $periodes = $query->orderBy('tanggal_mulai', 'desc')->get();

        return view('periode-magang.index', compact('periodes', 'filterStatus'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('periode-magang.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'nama_batch' => 'required|string|max:255',
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'is_active' => 'boolean',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'nama_batch.required' => 'Nama batch wajib diisi',
            'nama_periode.required' => 'Nama periode wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ]);

        $validated['is_active'] = $request->has('is_active');
        $validated['created_by'] = Auth::id();

        PeriodeMagang::create($validated);

        return redirect()->route('periode-magang.index')
            ->with('success', 'Periode magang berhasil ditambahkan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $periode = PeriodeMagang::with('creator')->findOrFail($id);
        return view('periode-magang.show', compact('periode'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $periode = PeriodeMagang::findOrFail($id);
        return view('periode-magang.edit', compact('periode'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $periode = PeriodeMagang::findOrFail($id);

        $validated = $request->validate([
            'nama_batch' => 'required|string|max:255',
            'nama_periode' => 'required|string|max:255',
            'tanggal_mulai' => 'required|date',
            'tanggal_selesai' => 'required|date|after:tanggal_mulai',
            'is_active' => 'boolean',
            'keterangan' => 'nullable|string|max:1000',
        ], [
            'nama_batch.required' => 'Nama batch wajib diisi',
            'nama_periode.required' => 'Nama periode wajib diisi',
            'tanggal_mulai.required' => 'Tanggal mulai wajib diisi',
            'tanggal_selesai.required' => 'Tanggal selesai wajib diisi',
            'tanggal_selesai.after' => 'Tanggal selesai harus setelah tanggal mulai',
        ]);

        $validated['is_active'] = $request->has('is_active');

        $periode->update($validated);

        return redirect()->route('periode-magang.index')
            ->with('success', 'Periode magang berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $periode = PeriodeMagang::findOrFail($id);
        $periode->delete();

        return redirect()->route('periode-magang.index')
            ->with('success', 'Periode magang berhasil dihapus');
    }

    /**
     * Toggle active status of a periode
     */
    public function toggleStatus(string $id)
    {
        $periode = PeriodeMagang::findOrFail($id);
        $periode->update(['is_active' => !$periode->is_active]);

        $status = $periode->is_active ? 'diaktifkan' : 'dinonaktifkan';
        return redirect()->route('periode-magang.index')
            ->with('success', "Periode magang berhasil {$status}");
    }
}
