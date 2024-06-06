<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EmergencyContact extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'contact_name',
        'contact_relationship',
        'contact_tel',
        'contact_cell',
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
