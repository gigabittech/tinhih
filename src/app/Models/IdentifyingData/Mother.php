<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;
class Mother extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'mother_type',
        'mother_name',
        'mother_ssn',
        'mother_dob',
        'mother_current_address',
        'mother_home_phone',
        'mother_cell_phone',
        'mother_email',
        'client_live_with_the_mother',
        'mother_health_insurance_for_client',
        'mother_primary_insurance_name',
        'mother_primary_insurance_id',
        'mother_primary_insurance_group',
        'mother_secondary_insurance_name',
        'mother_Secondary_insurance_id',
        'mother_Secondary_insurance_group',
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


    public function GetData($data)
    {
        return $data;
    }
}
