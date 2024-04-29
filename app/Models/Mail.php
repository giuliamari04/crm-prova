<?php
namespace App\Models;

use App\Models\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Product;

class Mail extends Model
{
    use HasFactory;
    protected $fillable = ['name', 'surname', 'company_name', 'client_id'];
    public function client()
    {
        return $this->belongsTo(Client::class);
    }
}

