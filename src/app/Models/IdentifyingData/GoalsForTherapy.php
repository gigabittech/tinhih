<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GoalsForTherapy extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'goals',
    ];


    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }




    public function GetData($data)
    {
        return $data;
    }

}
