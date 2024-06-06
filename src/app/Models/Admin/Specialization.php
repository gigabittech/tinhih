<?php

namespace App\Models\Admin;

use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use PhpParser\Comment\Doc;

class Specialization extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'image',
        'description',
        'title'
    ];

    public function providers()
    {
        return $this->belongsToMany(Provider::class, 'dr_specializations');
    }

    public function GetData($data)
    {
        if (isset($data['image']))
        {
            $data['image']= $this->UploadImage($data['image']);

        }
        if (isset($data['icon']))
        {
            $data['icon'] = $this->UploadImage($data['icon'],'icons');

        }

        return $data;
    }




}
