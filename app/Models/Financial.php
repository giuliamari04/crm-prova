<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Financial extends Model
{
    protected $table = 'financials';
    protected $fillable = [
        'client_id',
        'invoice_number',
        'amount',
        'due_date',
        'paid',
    ];

    protected $casts = [
        'due_date' => 'datetime',
        'paid' => 'boolean',
    ];

    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}
