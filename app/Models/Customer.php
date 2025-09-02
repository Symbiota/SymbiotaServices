<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory;
    protected $table = 'customers';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'darbi_customer_account_number',
        'darbi_site',
        'correspondence',
        'notes',
        'department_name',
        'address_line_1',
        'address_line_2',
        'city',
        'state',
        'zip_code',
        'country',
    ];

    // A customer has many contracts
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }
}
