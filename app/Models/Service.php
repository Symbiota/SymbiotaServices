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
        'line_ref_1',
        'line_ref_2',
        'active_status'
    ];

    // Services have a many-to-many relationship with invoices
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('qty', 'amount_owed');
    }
}
