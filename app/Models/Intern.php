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
        'email_kampus',
        'no_wa',
        'file_proposal',
        'file_cv',
        'file_surat',
        'file_formulir',
        'status',
        'rejection_reason',
        'document_checked',
        'document_checked_at',
        'created_by'
    ];

    protected $casts = [
        'document_checked' => 'boolean',
        'document_checked_at' => 'datetime',
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
