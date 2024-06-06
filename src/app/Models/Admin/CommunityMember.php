<?php

namespace App\Models\Admin;

use App\Traits\CommonFunctions;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;

class CommunityMember extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'user_id',
        'full_name',
        'dob',
        'gender',
        'community_member_image',
        'mailing_address',
        'recovery_date',
        'recovery_program',
        'support_services',
        'emergency_contact',
        'additional_info',
        'note',
    ];


    public function GetData($data)
     {

         if (isset($data['community_member_image']))
         {
             $data['community_member_image']= $this->UploadImage($data['community_member_image'],'community_member');

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
