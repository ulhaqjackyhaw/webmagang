<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasOne;

class Intern extends Model
{
    protected $fillable = [
        'nama',
        'jenis_kelamin',
        'periode_magang',
        'nim',
        'asal_kampus',
        'program_studi',
        'kelas',
        'semester',
        'tujuan_magang',
        'email_kampus',
        'no_wa',
        'file_proposal',
        'file_cv',
        'file_surat',
        'file_formulir',
        // New file fields
        'file_transkrip',
        'file_ktp_ktm',
        'file_bpjs',
        // Keterangan surat magang
        'nomor_surat_kampus',
        'tanggal_surat',
        'perihal_surat',
        'pengirim_surat',
        // Tanggal magang dalam periode
        'tanggal_mulai_magang',
        'tanggal_selesai_magang',
        // Administration status
        'surat_konfirmasi_unit_downloaded',
        'surat_ke_kampus_downloaded',
        'wa_onboarding_sent',
        'status',
        'rejection_reason',
        'document_checked',
        'document_checked_at',
        'created_by'
    ];

    protected $casts = [
        'document_checked' => 'boolean',
        'document_checked_at' => 'datetime',
        'tanggal_surat' => 'date',
        'tanggal_mulai_magang' => 'date',
        'tanggal_selesai_magang' => 'date',
        'surat_konfirmasi_unit_downloaded' => 'boolean',
        'surat_ke_kampus_downloaded' => 'boolean',
        'wa_onboarding_sent' => 'boolean',
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function acceptedIntern(): HasOne
    {
        return $this->hasOne(AcceptedIntern::class);
    }
}
