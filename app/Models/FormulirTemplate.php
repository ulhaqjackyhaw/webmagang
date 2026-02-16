<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class FormulirTemplate extends Model
{
    protected $fillable = [
        'nama_formulir',
        'deskripsi',
        'file_path',
        'is_active',
        'uploaded_by'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    public function uploader(): BelongsTo
    {
        return $this->belongsTo(User::class, 'uploaded_by');
    }
}
