<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserSymtoms extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'symtoms_id'
    ];


    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }
    public function userSymptoms()
    {
        return $this->hasOne(UserSymtoms::class,"client_id");
    }
    

    public function symtom()
    {
        return $this->belongsTo(CoRealatedSymptoms::class,);
    }


    public function GetData($data)
    {
        return $data;
    }


}
