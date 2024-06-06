<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OtherInsurance extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'child_covered_by_any_other_insurance',
        'what_state_is_the_coverage_in',
        'insurance_name',
        'insurance_id',
        'insurance_group',
    ];



    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }
    public function insurance_information()
    {
        return $this->belongsTo(Insurance::class, 'client_id');

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
