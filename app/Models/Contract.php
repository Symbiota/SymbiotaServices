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
        'darbi_header_ref_1',
        'darbi_header_ref_2',
        'darbi_special_instructions',
        'notes',
        'start_date',
        'end_date'
    ];
    
    // A contract belong to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // A contract belongs to many services
    public function services()
    {
        return $this->belongsToMany(Service::class);
    }

    // A contract has multiple invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}