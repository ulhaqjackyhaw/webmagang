<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class PeriodeMagang extends Model
{
    protected $fillable = [
        'nama_batch',
        'nama_periode',
        'tanggal_mulai',
        'tanggal_selesai',
        'batas_pendaftaran',
        'is_active',
        'keterangan',
        'created_by',
    ];

    protected $casts = [
        'tanggal_mulai' => 'date',
        'tanggal_selesai' => 'date',
        'batas_pendaftaran' => 'date',
        'is_active' => 'boolean',
    ];

    /**
     * Get the user who created this period
     */
    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }

    /**
     * Scope for active periods
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for open registration periods (active and start date not passed)
     */
    public function scopeOpenForRegistration($query)
    {
        return $query->where('is_active', true)
            ->where('tanggal_mulai', '>', now()->toDateString());
    }

    /**
     * Check if registration is still open
     */
    public function isOpenForRegistration(): bool
    {
        return $this->is_active && $this->tanggal_mulai > now()->toDateString();
    }

    /**
     * Get formatted duration (e.g., "3 bulan")
     */
    public function getDurasiAttribute(): string
    {
        $start = \Carbon\Carbon::parse($this->tanggal_mulai);
        $end = \Carbon\Carbon::parse($this->tanggal_selesai);
        $diff = round($start->floatDiffInMonths($end));
        return $diff . ' bulan';
    }
}
