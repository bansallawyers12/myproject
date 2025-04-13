<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class EntityPerson extends Model
{
    protected $table = 'entity_person';

    protected $fillable = [
        'business_entity_id',
        'person_id',
        'entity_trustee_id',
        'role',
        'appointment_date',
        'resignation_date',
        'role_status',
        'shares_percentage',
        'authority_level',
        'asic_updated',
        'asic_due_date',
    ];

    protected $casts = [
        'appointment_date' => 'datetime',
        'resignation_date' => 'datetime',
        'asic_due_date' => 'datetime',
        'shares_percentage' => 'decimal:2',
        'asic_updated' => 'boolean',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
    ];

    public function businessEntity()
    {
        return $this->belongsTo(BusinessEntity::class, 'business_entity_id');
    }

    public function person()
    {
        return $this->belongsTo(Person::class, 'person_id');
    }

    public function trusteeEntity()
    {
        return $this->belongsTo(BusinessEntity::class, 'entity_trustee_id');
    }

    public function scopeDueWithin15Days($query)
    {
        return $query->where(function ($query) {
            $query->whereBetween('asic_due_date', [now(), now()->addDays(15)])
                  ->where('asic_updated', false)
                  ->where('role_status', 'Active');
        });
    }
}