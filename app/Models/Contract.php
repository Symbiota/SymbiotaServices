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
    ];
    
    // A contract belongs to a customer
    public function customer()
    {
        return $this->belongsTo(Customer::class);
    }

    // A contract has multiple invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}