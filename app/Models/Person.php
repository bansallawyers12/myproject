<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Person extends Model
{
    protected $table = 'persons'; // Explicitly set table name

    protected $fillable = [
        'first_name',
        'last_name',
        'email',
        'tfn', // Use existing tax_file_number column
        'abn', // New column
        'phone_number',
        'address',
        'identification_number',
        'nationality',
        'status',
    ];

    public function businessEntities()
    {
        return $this->belongsToMany(BusinessEntity::class, 'entity_person')
            ->withPivot(['role', 'appointment_date', 'resignation_date', 'role_status', 'shares_percentage', 'authority_level', 'asic_updated', 'asic_due_date'])
            ->withTimestamps();
    }
}