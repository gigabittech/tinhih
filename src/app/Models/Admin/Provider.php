<?php

namespace App\Models\Admin;

use App\Traits\CommonFunctions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class Provider extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'provider_image',
        'address',
        'dob',
        'note',
        'designation',
        'Work_location',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function certification()
    {
        return $this->hasMany(Certification::class);
    }


    public function specializations()
    {
        return $this->belongsToMany(Specialization::class, 'dr_specializations');
    }

    public function drcertificate()
    {
        return $this->hasMany(DrCertificate::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function provider_schedule()
    {
        return $this->hasMany(ProviderSchedule::class);
    }


     /****************************
     * Public Methods area
     *****************************/

     public function GetData($data)
     {

         if (isset($data['provider_image']))
         {
             $data['provider_image']= $this->UploadImage($data['provider_image'],'providers');

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