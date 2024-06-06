<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Father extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'father_type',
        'father_name',
        'father_ssn',
        'father_dob',
        'father_current_address',
        'father_home_phone',
        'father_cell_phone',
        'father_email',
        'client_live_with_the_father',
        'health_insurance_for_client',
        'father_primary_insurance_name',
        'primary_insurance_id',
        'father_primary_insurance_group',
        'father_secondary_insurance_name',
        'father_secondary_insurance_id',
        'father_secondary_insurance_group',
        'step_living_with_the_client',
        'health_insurance_policy',
        'coverage_in',
        'parent_name',
        'parent_name_ssn',
        'parent_name_dob',
        'parent_current_address',
        'parent_home_phone',
        'parent_cell_phone',
        'parent_email',
        'parent_primary_insurance_name',
        'parent_primary_insurance_id',
        'parent_primary_insurance_group',
        'parent_secondary_insurance_name',
        'parent_secondary_insurance_id',
        'parent_secondary_insurance_id',
        'parent_secondary_insurance_group',
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
    public function mother()
    {
        return $this->hasOne(Mother::class, "client_id");
    }



    public function GetData($data)
    {
        return $data;
    }
}
