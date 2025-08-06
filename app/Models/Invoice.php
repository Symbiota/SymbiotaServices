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
        'billing_start',
        'billing_end',
        'amount_billed',
        'date_invoiced',
        'date_paid',
        'notes',
    ];
    
    // An invoice belongs to a contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }

}