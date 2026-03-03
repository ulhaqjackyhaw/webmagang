<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class AcceptedIntern extends Model
{
    protected $fillable = [
        'intern_id',
        'periode_magang',
        'unit_magang',
        'approval_status',
        'documents_verified',
        'documents_verified_at',
        'documents_verified_by',
        'viewed_cv',
        'viewed_transkrip',
        'viewed_ktp_ktm',
        'viewed_bpjs',
        'viewed_surat',
        'sent_to_divhead_at',
        'approved_divhead_at',
        'sent_to_deputy_at',
        'approved_deputy_at',
        'approved_by_divhead',
        'approved_by_deputy',
        'rejection_reason',
        'rejected_by',
        'rejected_at',
        'rejection_wa_sent',
        // Persuratan fields
        'surat_konfirmasi_unit_downloaded',
        'surat_ke_kampus_downloaded',
        'wa_onboarding_sent',
        'tanggal_mulai',
        'tanggal_selesai',
        'created_by'
    ];

    protected $casts = [
        'documents_verified' => 'boolean',
        'documents_verified_at' => 'datetime',
        'viewed_cv' => 'boolean',
        'viewed_transkrip' => 'boolean',
        'viewed_ktp_ktm' => 'boolean',
        'viewed_bpjs' => 'boolean',
        'viewed_surat' => 'boolean',
        'sent_to_divhead_at' => 'datetime',
        'approved_divhead_at' => 'datetime',
        'sent_to_deputy_at' => 'datetime',
        'approved_deputy_at' => 'datetime',
        'rejected_at' => 'datetime',
        'rejection_wa_sent' => 'boolean',
        'surat_konfirmasi_unit_downloaded' => 'boolean',
        'surat_ke_kampus_downloaded' => 'boolean',
        'wa_onboarding_sent' => 'boolean',
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
    ];

    public function intern(): BelongsTo
    {
        return $this->belongsTo(Intern::class);
    }

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    public function approverDivHead(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_divhead');
    }

    public function approverDeputy(): BelongsTo
    {
        return $this->belongsTo(User::class, 'approved_by_deputy');
    }

    public function rejector(): BelongsTo
    {
        return $this->belongsTo(User::class, 'rejected_by');
    }

    /**
     * Get rejection source label (who rejected)
     */
    public function getRejectionSourceAttribute(): string
    {
        if (!$this->rejector) {
            return 'Unknown';
        }

        return match ($this->rejector->role) {
            'hc' => 'HC',
            'div_head' => 'Div Head',
            'deputy' => 'Deputy',
            'admin' => 'Admin',
            default => $this->rejector->name
        };
    }

    /**
     * Get approval status label
     */
    public function getApprovalStatusLabelAttribute(): string
    {
        // Check for pending with document verification status
        if ($this->approval_status === 'pending') {
            return $this->documents_verified ? 'Dokumen Telah Dibaca' : 'Dokumen Belum Dibaca';
        }

        return match ($this->approval_status) {
            'sent_to_divhead' => 'Dikirim ke Div Head',
            'approved_divhead' => 'Disetujui Div Head',
            'sent_to_deputy' => 'Terkirim ke Deputy',
            'approved_deputy' => 'Disetujui Deputy (Final)',
            'rejected' => 'Ditolak',
            default => 'Unknown'
        };
    }

    /**
     * Get approval status color for UI (Tailwind CSS classes)
     */
    public function getApprovalStatusColorAttribute(): string
    {
        // Check for pending with document verification status
        if ($this->approval_status === 'pending') {
            return $this->documents_verified ? 'bg-cyan-100 text-cyan-800' : 'bg-gray-100 text-gray-800';
        }

        return match ($this->approval_status) {
            'sent_to_divhead' => 'bg-yellow-100 text-yellow-800',
            'approved_divhead' => 'bg-blue-100 text-blue-800',
            'sent_to_deputy' => 'bg-orange-100 text-orange-800',
            'approved_deputy' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }

    /**
     * Relationship to documents verifier
     */
    public function documentsVerifier(): BelongsTo
    {
        return $this->belongsTo(User::class, 'documents_verified_by');
    }
}
