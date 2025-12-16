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

    // Multiple contracts can be linked to one contact
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    // Multiple invoices can be linked to one contact
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
