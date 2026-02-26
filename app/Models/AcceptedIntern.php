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
        'sent_to_divhead_at',
        'approved_divhead_at',
        'sent_to_deputy_at',
        'approved_deputy_at',
        'approved_by_divhead',
        'approved_by_deputy',
        'rejection_reason',
        'created_by'
    ];

    protected $casts = [
        'sent_to_divhead_at' => 'datetime',
        'approved_divhead_at' => 'datetime',
        'sent_to_deputy_at' => 'datetime',
        'approved_deputy_at' => 'datetime',
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

    /**
     * Get approval status label
     */
    public function getApprovalStatusLabelAttribute(): string
    {
        return match ($this->approval_status) {
            'pending' => 'Menunggu Dikirim',
            'sent_to_divhead' => 'Terkirim ke Div Head',
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
        return match ($this->approval_status) {
            'pending' => 'bg-gray-100 text-gray-800',
            'sent_to_divhead' => 'bg-yellow-100 text-yellow-800',
            'approved_divhead' => 'bg-blue-100 text-blue-800',
            'sent_to_deputy' => 'bg-orange-100 text-orange-800',
            'approved_deputy' => 'bg-green-100 text-green-800',
            'rejected' => 'bg-red-100 text-red-800',
            default => 'bg-gray-100 text-gray-800'
        };
    }
}
