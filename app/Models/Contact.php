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
    ];

    // A contact can have multiple invoices
    public function invoices()
    {
        return $this->hasMany(Invoice::class);
    }
}
