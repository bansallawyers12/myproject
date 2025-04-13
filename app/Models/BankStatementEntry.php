<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BankStatementEntry extends Model
{
    protected $fillable = [
        'bank_account_id',
        'date',
        'amount',
        'description',
        'transaction_type',
        'transaction_id',
    ];

    protected $casts = [
        'date' => 'date',
        'amount' => 'decimal:2',
    ];

    public function bankAccount()
    {
        return $this->belongsTo(BankAccount::class);
    }

    public function transaction()
    {
        return $this->belongsTo(Transaction::class);
    }
}