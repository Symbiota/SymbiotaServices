<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contact extends Model
{
    use HasFactory;
    protected $table = 'contacts';

    public $timestamps = true;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'phone_number',
        'notes',
        'full_name'
    ];

    // Multiple contracts can be linked to one contact by the original_contact_id
    public function contracts_by_original_contact()
    {
        return $this->hasMany(Contract::class, 'original_contact_id');
    }

    // Multiple contracts can be linked to one contact by the current_financial_contact_id
    public function contracts_by_current_financial_contact()
    {
        return $this->hasMany(Contract::class, 'current_financial_contact_id');
    }

    // Multiple contracts can be linked to one contact by the pi_contact_id
    public function contracts_by_pi_contact()
    {
        return $this->hasMany(Contract::class, 'pi_contact_id');
    }

    // Multiple contracts can be linked to one contact by the original_contact_id
    public function contracts_by_technical_contact()
    {
        return $this->hasMany(Contract::class, 'technical_contact_id');
    }

    // Multiple invoices can be linked to one contact
    public function invoices()
    {
        return $this->hasMany(Invoice::class, 'financial_contact_id');
    }
}
