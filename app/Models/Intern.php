<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Intern extends Model
{
    protected $fillable = [
        'nama',
        'nim',
        'asal_kampus',
        'program_studi',
        'email_kampus',
        'no_wa',
        'file_proposal',
        'file_cv',
        'file_surat',
        'status',
        'rejection_reason',
        'created_by'
    ];

    public function creator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'created_by');
    }
}
