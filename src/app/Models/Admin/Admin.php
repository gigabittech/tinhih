<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Auth;
use App\Traits\CommonFunctions;

class Admin extends Model
{
    use CommonFunctions;
    protected $fillable = [
        'user_id',
        'first_name',
        'last_name',
        'phone_number',
        'address',
        'dob',
        'note',
        'phone_number',
        'admin_image',
    ];

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }



    public function GetData($data)
    {

        // dd($data);
        if (isset($data['admin_image'])) {
            $data['admin_image'] = $this->UploadImage($data['admin_image'], '', 'profile');
        }

        if (isset($data['icon'])) {
            $data['icon'] = $this->UploadImage($data['icon'], 'icons');

        }
        $data['user_id'] = Auth::user()->id;

        //dd($data);
        //$data['parent_id']=$this->GetParentId($data);

        return $data;
    }
}