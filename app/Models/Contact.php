<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\DB;

class Contact extends Model {

    protected $table = 'contacts';

    public $timestamps = true;

    public $fillable = [
        'first_name',
        'last_name',
        'email',
        'notes',
    ];

    /**
     * @return Collection
     */
    public static function getContacts(): Collection {
        Contact::orderBy('last_name', 'DESC')->get();
    }

}