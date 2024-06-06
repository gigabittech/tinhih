<?php

namespace App\Models;

use App\Models\Communication\Chat;
use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Models\Admin\Provider;
use App\Models\Admin\Client;
use App\Models\Admin\Admin;
use App\Models\Admin\CommunityMember;
use App\Models\Admin\ProviderSchedule;
use App\Models\IdentifyingData\DFSCustody;
use App\Models\IdentifyingData\DomesticViolenceScreening;
use App\Models\IdentifyingData\EmergencyContact;
use App\Models\IdentifyingData\Father;
use App\Models\IdentifyingData\GoalsForTherapy;
use App\Models\IdentifyingData\HouseholdMembers;
use App\Models\IdentifyingData\Insurance;
use App\Models\IdentifyingData\Mother;
use App\Models\IdentifyingData\OtherInsurance;
use App\Models\IdentifyingData\PriorTreatment;
use App\Models\IdentifyingData\SchoolWorkIdentifyingData;
use App\Models\IdentifyingData\Symtoms;
use App\Models\IdentifyingData\UserCoRealatedSymtoms;
use App\Models\IdentifyingData\UserSymtoms;
use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use CommonFunctions;
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     *
     */
    protected $fillable = [
        'unique_id',
        'gauth_id',
        'gauth_type',
        'name',
        'type',
        'is_active',
        'email',
        'phone',
        'password',
        'is_approved',
        'is_active',
        'is_new',
        'is_blocked',
        'social_login_provider_name',
        'social_login_user_id'

    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function admin()
    {
        return $this->hasOne(Admin::class);
    }
    public function insurance_information()
    {
        return $this->hasOne(Insurance::class, "client_id");
    }
    public function insurance_information_two()
    {
        return $this->hasOne(OtherInsurance::class, "client_id");
    }
    public function parents_information()
    {
        return $this->hasOne(Father::class, "client_id");
    }
    public function parents_informations()
    {
        return $this->hasOne(Mother::class, "client_id");
    }
    public function household_emergency_contact()
    {
        return $this->hasOne(HouseholdMembers::class, "client_id");
    }
    public function household_emergency_contact_two()
    {
        return $this->hasOne(EmergencyContact::class, "client_id");
    }
    public function prior_treatment_therapy_goal()
    {
        return $this->hasOne(PriorTreatment::class, "client_id");
    }
    public function prior_treatment_therapy_goal_two()
    {
        return $this->hasOne(GoalsForTherapy::class, "client_id");
    }
    public function DFS_custody()
    {
        return $this->hasOne(DFSCustody::class, "client_id");
    }
    public function domestic_violence_screening()
    {
        return $this->hasOne(DomesticViolenceScreening::class, "client_id");
    }
    public function school_work_data()
    {
        return $this->hasOne(SchoolWorkIdentifyingData::class, "client_id");
    }
    public function symtom()
    {
        return $this->hasOne(Symtoms::class, "id");
    }

    // public function userSymptoms()
    // {
    //     return $this->hasOne(UserSymtoms::class,"client_id");
    // }
//     public function userSymptoms()
// {
//     return $this->hasMany(UserSymtoms::class, "client_id");
// }


    public function user_co_realated_symptom()
    {
        return $this->hasOne(UserCoRealatedSymtoms::class, "client_id");
    }


    public function other_information()
    {
        return $this->hasOne(OtherInsurance::class, "client_id");
    }


    public function client()
    {
        return $this->hasOne(Client::class);
    }

    public function provider()
    {
        return $this->hasOne(Provider::class);
    }
    public function provider_schedule()
    {
        return $this->hasOne(ProviderSchedule::class);
    }

    public function community_member()
    {
        return $this->hasOne(CommunityMember::class);
    }


    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function sentMessages()
    {
        return $this->hasMany(Chat::class, 'sender_id');
    }


    public function receivedMessages()
    {
        return $this->hasMany(Chat::class, 'receiver_id');
    }



    // public function insurance()
    // {
    //     return $this->hasOne(Insurance::class);
    // }


    public function GetData($data)
    {

        if (isset($data['image'])) {
            $data['image'] = $this->UploadImage($data['image'], 'categories');

        }
        if (isset($data['icon'])) {
            $data['icon'] = $this->UploadImage($data['icon'], 'icons');

        }

        //$data['parent_id']=$this->GetParentId($data);

        return $data;
    }
}