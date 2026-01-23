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
        'active_status',
    ];

    protected $attributes = [
        'active_status' => true,
    ];

    // Services have a many-to-many relationship with invoices
    public function invoices()
    {
        return $this->belongsToMany(Invoice::class)->withPivot('qty', 'amount_owed', 'line_ref_1', 'line_ref_2');
    }

    public function history()
    {
        $history = DB::table('services_history')->where('service_id', $this->id)->get();
        return $history;
    }
}
