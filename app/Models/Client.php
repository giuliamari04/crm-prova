<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Client extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $table = 'clients';
    protected $fillable = [
        'company_id',
        'first_name',
        'last_name',
        'email',
        'phone',
        'industry',
        'p_iva',
        'codice_fiscale',
        'address',
        'city',
        'postal_code',
        'province',
        'country',
        'status',
        'contract_start_date',
        'contract_end_date',
    ];
    public function company()
    {
        return $this->hasMany(Company::class);
    }
}
