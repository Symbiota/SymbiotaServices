<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Services extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'price_per_unit',
        'darbi_item_number'
    ];

    // A service belongs to a contract
    public function contract()
    {
        return $this->belongsTo(Contract::class);
    }
}