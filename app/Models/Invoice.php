<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Invoice extends Model
{
    use HasFactory;
    protected $table = 'invoices';

    protected $fillable = [
        'contract_id',
        'financial_contact_id',
        'billing_start',
        'billing_end',
        'amount_billed',
        'date_invoiced',
        'date_paid',
        'darbi_header_ref_1',
        'darbi_header_ref_2',
        'notes',
    ];

    // An invoice belongs to one contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

    // Invoices have a many-to-many relationship with services (items)
    public function services()
    {
        return $this->belongsToMany(Service::class)->withPivot('qty', 'amount_owed', 'line_ref_1', 'line_ref_2');
    }

    // An invoice belongs to one contact
    public function financial_contact()
    {
        return $this->belongsTo(Contact::class, 'financial_contact_id');
    }
}
