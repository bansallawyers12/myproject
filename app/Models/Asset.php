<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Asset extends Model
{
    protected $fillable = [
        'business_entity_id',
        'user_id',
        'asset_type',
        'name',
        'acquisition_date',
        'acquisition_cost',
        'current_value',
        'status',
        'description',
        'registration_number',
        'registration_due_date',
        'insurance_company',
        'insurance_due_date',
        'insurance_amount',
        'vin_number',
        'mileage',
        'fuel_type',
        'service_due_date',
        'vic_roads_updated',
        'address',
        'square_footage',
        'council_rates_amount',
        'council_rates_due_date',
        'owners_corp_amount',
        'owners_corp_due_date',
        'land_tax_amount',
        'land_tax_due_date',
        'sro_updated',
        'real_estate_percentage',
        'rental_income',
    ];

    protected $casts = [
        'acquisition_date' => 'datetime',
        'registration_due_date' => 'datetime',
        'insurance_due_date' => 'datetime',
        'service_due_date' => 'datetime',
        'council_rates_due_date' => 'datetime',
        'owners_corp_due_date' => 'datetime',
        'land_tax_due_date' => 'datetime',
        'created_at' => 'datetime',
        'updated_at' => 'datetime',
        'acquisition_cost' => 'decimal:2',
        'current_value' => 'decimal:2',
        'insurance_amount' => 'decimal:2',
        'council_rates_amount' => 'decimal:2',
        'owners_corp_amount' => 'decimal:2',
        'land_tax_amount' => 'decimal:2',
        'vic_roads_updated' => 'boolean',
        'sro_updated' => 'boolean',
        'mileage' => 'integer',
        'square_footage' => 'integer',
        'real_estate_percentage' => 'decimal:2',
        'rental_income' => 'decimal:2',
    ];

    public function businessEntity()
    {
        return $this->belongsTo(BusinessEntity::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function assetTransactions()
    {
        return $this->hasMany(AssetTransaction::class);
    }

    public function tenants()
    {
        return $this->hasMany(Tenant::class);
    }

    public function leases()
    {
        return $this->hasMany(Lease::class);
    }

    public function notes()
    {
        return $this->hasMany(Note::class);
    }

    public function reminders()
    {
        return $this->morphMany(Reminder::class, 'reminder');
    }

    /**
     * Get all pending reminders for the asset.
     */
    public function pendingReminders()
    {
        return $this->reminders()->pending();
    }

    /**
     * Get all overdue reminders for the asset.
     */
    public function overdueReminders()
    {
        return $this->reminders()->overdue();
    }

    public static function dueWithin15Days($includeInactive = false)
    {
        $query = self::whereNotNull('business_entity_id');

        if (!$includeInactive) {
            $query->where('status', 'Active');
        }

        return $query->where(function ($query) {
            $startDate = now();
            $endDate = now()->addDays(15);
            $dateFields = [
                'registration_due_date',
                'insurance_due_date',
                'service_due_date',
                'council_rates_due_date',
                'owners_corp_due_date',
                'land_tax_due_date',
            ];

            foreach ($dateFields as $field) {
                $query->orWhere(function ($q) use ($field, $startDate, $endDate) {
                    $q->whereNotNull($field)
                      ->whereBetween($field, [$startDate, $endDate]);
                });
            }
            return $query;
        });
    }
}