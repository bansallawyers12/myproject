<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tenant extends Model
{
    protected $fillable = [
        'asset_id', 'name', 'email', 'phone', 'address',
        'move_in_date', 'move_out_date', 'notes',
    ];

    protected $casts = [
        'move_in_date' => 'datetime',
        'move_out_date' => 'datetime',
    ];

    public function asset()
    {
        return $this->belongsTo(Asset::class);
    }
}
