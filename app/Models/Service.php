<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Service extends Model
{
    use HasFactory;
    protected $table = 'services';

    protected $fillable = [
        'name',
        'description',
        'price_per_unit',
        'darbi_item_number',
        'active_status'
    ];

    // A service belongs to many contracts
    public function contracts()
    {
        return $this->belongsToMany(Contract::class);
    }
}