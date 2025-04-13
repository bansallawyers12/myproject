<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class BusinessEntity extends Model
{
    protected $fillable = [
        'legal_name',
        'trading_name',
        'entity_type',
        'abn',
        'acn',
        'tfn',
        'corporate_key',
        'registered_address',
        'registered_email',
        'phone_number',
        'asic_renewal_date',
        'user_id',
        'status',
    ];

    protected $casts = [
        'asic_renewal_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class, 'business_entity_id');
    }

    public function assets()
    {
        return $this->hasMany(Asset::class, 'business_entity_id');
    }

    public function persons()
    {
        return $this->hasMany(EntityPerson::class, 'business_entity_id');
    }
    public function bankAccounts()
{
    return $this->hasMany(BankAccount::class);
}


public function transactions()
{
    return $this->hasMany(Transaction::class);
}

public function reminders()
{
    return $this->morphMany(Reminder::class, 'reminder');
}

/**
 * Get all pending reminders for the business entity.
 */
public function pendingReminders()
{
    return $this->reminders()->pending();
}

/**
 * Get all overdue reminders for the business entity.
 */
public function overdueReminders()
{
    return $this->reminders()->overdue();
}

}