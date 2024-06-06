<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Insurance extends Model
{
    use HasFactory;

    protected $fillable = [
        'client_id',
        'primary_insurance_name',
        'primary_insurance_name',
        'primary_insurance_id',
        'primary_insurance_group',
        'secondary_insurance_name',
        'secondary_insurance_id',
        'secondary_insurance_group',
        'spouse_primary_insurance_name',
        'spouse_primary_insurance_id',
        'spouse_primary_insurance_group',
        'spouse_secondary_insurance_name',
        'spouse_secondary_insurance_id',
        'spouse_secondary_insurance_group',
        'commercial_insurance_policy',
        'policy_still_current',
        'coverage_expire',
        'expiration_date',
        'coverage_expire',
        'marital_status',
        'legal_custody',
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
    public function otherInsurance()
    {
        return $this->hasOne(OtherInsurance::class, 'insurance_id');
    } 

    public function GetData($data)
    {
        return $data;
    }

}