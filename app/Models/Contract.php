<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Contract extends Model
{
    use HasFactory;
    protected $table = 'contracts';

    protected $fillable = [
        'id',
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

    // A contract has many services
    public function services()
    {
        return $this->hasMany(Service::class);
    }
}