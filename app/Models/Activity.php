<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Activity extends Model
{
    protected $table = 'activities';
    protected $fillable = [
        'client_id',
        'activity_date',
        'subject',
        'status',
    ];

    protected $dates = [
        'activity_date',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
