<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class AssetDocument extends Model
{
    protected $fillable = [
        'asset_id',
        'file_path',
        'file_name',
        'file_type',
        'document_type',
        'mime_type',
        'file_size',
    ];

    public function asset(): BelongsTo
    {
        return $this->belongsTo(Asset::class);
    }

    public function getFileSizeAttribute($value)
    {
        $units = ['B', 'KB', 'MB', 'GB', 'TB'];
        $bytes = $value;
        $pow = floor(($bytes ? log($bytes) : 0) / log(1024));
        $pow = min($pow, count($units) - 1);
        $bytes /= pow(1024, $pow);
        return round($bytes, 2) . ' ' . $units[$pow];
    }

    public function getFileUrl()
    {
        return Storage::disk('s3')->temporaryUrl($this->file_path, now()->addMinutes(5));
    }
}
