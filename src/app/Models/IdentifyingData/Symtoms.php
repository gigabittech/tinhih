<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Symtoms extends Model
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

    public function co_realated_symptom()
    {
        return $this->hasOne(UserSymtoms::class,"client_id");
    }
    public function user_co_realated_symptom()
    {
        return $this->hasOne(UserCoRealatedSymtoms::class,"client_id");
    }
 

    public function GetData($data)
    {
        return $data;
    }

}
