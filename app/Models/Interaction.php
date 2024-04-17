<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Interaction extends Model
{
    protected $table = 'interactions';
    protected $fillable = [
        'client_id',
        'type',
        'description',
        'date_time',
    ];

    protected $dates = [
        'date_time',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
