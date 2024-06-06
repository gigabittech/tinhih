<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HouseholdMembers extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'name',
        'age',
        'relationship'
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
