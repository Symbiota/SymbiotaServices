<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Customer extends Model {

    protected $table = 'customers';

    public $timestamps = true;

    public $fillable = [
        'name',
        'darbi_account',
    ];

    /**
     * @return Collection
     */
    public static function getCustomers(): Collection {
        Customer::orderBy('name', 'DESC')->get();
    }

}