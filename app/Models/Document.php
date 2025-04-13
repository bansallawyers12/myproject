<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Document extends Model
{
    use HasFactory;

    protected $fillable = [
        'business_entity_id',
        'asset_id',
        'file_name',
        'path',
        'type',
        'description',
        'filetype',
        'user_id',
    ];

    public function businessEntity()
    {
        return $this->belongsTo(BusinessEntity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getFileUrl()
    {
        return Storage::disk('s3')->temporaryUrl($this->path, now()->addMinutes(5));
    }

    public function asset()
{
    return $this->belongsTo(Asset::class);
}
}