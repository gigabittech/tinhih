<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PriorTreatment extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'previous_therapy',
        'location',
        'dates',
        'goals',
        'medication_name',
        'medication_purpose',
        'medication_dosage',
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
