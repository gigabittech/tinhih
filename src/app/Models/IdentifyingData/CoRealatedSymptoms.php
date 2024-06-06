<?php

namespace App\Models\IdentifyingData;

use App\Http\Middleware\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoRealatedSymptoms extends Model
{
    use HasFactory;
    protected $fillable = [
        'symtoms_name',
        'symtoms_type'
    ];

    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }

    public function GetData($data)
    {
        return $data;
    }
}

