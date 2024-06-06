<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DomesticViolenceScreening extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'violent_in_the_home',
        'violent_in_the_home_describe',
        'child_has_been_violent_in_the_home',
        'child_has_been_violent_in_the_home_describe',
        'my_spouse_has_been_violent_in_the_home',
        'my_spouse_has_been_violent_in_the_home_describe',
        'witnessed_domestic_violence',
        'witnessed_domestic_violence_describe',
        'weapons',
        'weapons_describe',
        'initials',
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
