<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = [
        'customer_id',
        'original_contact_id',
        'current_financial_contact_id',
        'pi_contact_id',
        'technical_contact_id',
        'darbi_header_ref_1',
        'darbi_header_ref_2',
        'darbi_special_instructions',
        'notes',
    ];

    // A contract belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // Multiple invoices can be linked to one contract
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }

    // Original contact id linked to a contact
    public function original_contact()
    {
        return $this->belongsTo(Contact::class, 'original_contact_id');
    }

    // Current financial id linked to a contact
    public function current_financial_contact()
    {
        return $this->belongsTo(Contact::class, 'current_financial_contact_id');
    }

    // PI id linked to a contact
    public function pi_contact()
    {
        return $this->belongsTo(Contact::class, 'pi_contact_id');
    }

    // Technical id linked to contact
    public function technical_contact()
    {
        return $this->belongsTo(Contact::class, 'technical_contact_id');
    }
}
