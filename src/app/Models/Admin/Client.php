<?php

namespace App\Models\Admin;

use App\Models\IdentifyingData\CoRealatedSymptoms;
use App\Models\IdentifyingData\DFSCustody;
use App\Models\IdentifyingData\DomesticViolenceScreening;
use App\Models\IdentifyingData\EmergencyContact;
use App\Models\IdentifyingData\Father;
use App\Models\IdentifyingData\GoalsForTherapy;
use App\Models\IdentifyingData\HouseholdMembers;
use App\Models\IdentifyingData\Insurance;
use App\Models\IdentifyingData\MaritalStatus;
use App\Models\IdentifyingData\Mother;
use App\Models\IdentifyingData\OtherInsurance;
use App\Models\IdentifyingData\PriorTreatment;
use App\Models\IdentifyingData\Relationship;
use App\Models\IdentifyingData\SchoolWorkIdentifyingData;
use App\Models\IdentifyingData\Symtoms;
use App\Models\IdentifyingData\UserCoRealatedSymtoms;
use App\Models\IdentifyingData\UserSymtoms;
use App\Traits\CommonFunctions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;


class Client extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'ssn',
        'dob',
        'age',
        'legal_guardian',
        'relationship',
        'address',
        'cell_phone',
        'are_parents_married',
        'are_parents_divorced',
        'legal_custody',
        'language',
        'cultural_background',
        'client_image',
        'note',
        "client_by_user_id"
    ];


    /****************************
     * Public Methods area
     *****************************/

  

     public function user()
     {
         return $this->belongsTo(User::class);
     }

    // Identifying Data Model Relationship

    public function co_realated_symptoms()
    {
        return $this->hasMany(CoRealatedSymptoms::class);
    }

    public function dfs_custody()
    {
        return $this->hasMany(DFSCustody::class);
    }

    public function domestic_violence_screening()
    {
        return $this->hasMany(DomesticViolenceScreening::class);
    }

    public function emergency_contact()
    {
        return $this->hasMany(EmergencyContact::class);
    }

    public function father()
    {
        return $this->hasMany(Father::class);
    }
    

    public function goals_for_therapy()
    {
        return $this->hasMany(GoalsForTherapy::class);
    }
    

    public function house_hold_members()
    {
        return $this->hasMany(HouseholdMembers::class);
    }
    

    public function insurance()
    {
        return $this->hasMany(Insurance::class);
    }
    

    public function marital_status()
    {
        return $this->hasMany(MaritalStatus::class);
    }
    

    public function mother()
    {
        return $this->hasMany(Mother::class);
    }
    

    public function other_insurance()
    {
        return $this->hasMany(OtherInsurance::class);
    }
    

    public function prior_treatment()
    {
        return $this->hasMany(PriorTreatment::class);
    }

    public function relationship()
    {
        return $this->hasMany(Relationship::class);
    }
    

    public function school_Work_identifying_data()
    {
        return $this->hasMany(SchoolWorkIdentifyingData::class);
    }
    

    public function symtoms()
    {
        return $this->hasMany(Symtoms::class);
    }
    

    public function user_co_related_symtoms()
    {
        return $this->hasMany(UserCoRealatedSymtoms::class);
    }
    

    public function user_symtoms()
    {
        return $this->hasMany(UserSymtoms::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }



    public function GetData($data)
    {

        if (isset($data['client_image']))
        {
            $data['client_image']= $this->UploadImage($data['client_image'], 'clients');

        }
        if (isset($data['icon']))
        {
            $data['icon'] = $this->UploadImage($data['icon'],'icons');

        }
        $data['user_id'] = Auth::user()->id;

        //dd($data);
        //$data['parent_id']=$this->GetParentId($data);

        return $data;
    }
}