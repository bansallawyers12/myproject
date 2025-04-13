<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankAccount extends Model
{
    protected $fillable = [
        'business_entity_id',
        'bank_name',
        'bsb',
        'account_number',
        'nickname',
    ];

    public function businessEntity()
    {
        return $this->belongsTo(BusinessEntity::class);
    }

    public function transactions()
    {
        return $this->hasMany(Transaction::class);
    }
    public function bankStatementEntries()
{
    return $this->hasMany(BankStatementEntry::class);
}
}