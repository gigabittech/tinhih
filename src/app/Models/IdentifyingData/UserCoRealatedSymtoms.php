<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserCoRealatedSymtoms extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'symtoms_id',
        'is_client',
        'is_mother',
        'is_father',
        'comments',
    ];


    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }

    public function co_related_symtom()
    {
        return $this->belongsTo(CoRealatedSymptoms::class);

    }




    public function GetData($data)
    {
        return $data;
    }


}
