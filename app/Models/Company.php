<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Company extends Model
{
    protected $fillable = [
        'client_id',
        'name',
        'email',
        'phone_number',
        'industry',
        'address',
        'city',
        'postal_code',
        'province',
        'country',
        'website',
        'status',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
