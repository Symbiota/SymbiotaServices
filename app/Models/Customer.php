<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model {

    use HasFactory;
    protected $table = 'customers';

    public $timestamps = true;

    protected $fillable = [
        'name',
        'darbi_account',
        'darbi_site',
        'correspondence',
        'notes'
    ];

    // A customer has many contracts
    public function contracts()
    {
        return $this->hasMany(Contract::class);
    }

    /**
     * @return Collection
     */
    // public static function getCustomers(): Collection {
    //     Customer::orderBy('name', 'DESC')->get();
    // }

}