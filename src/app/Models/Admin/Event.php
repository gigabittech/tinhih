<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Model;

class Event extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'title',
        'image',
        'status',
        'start_time',
        'end_time',
        'date',
        'location',
        'description',
        'external_link',
    ];



    public function GetData($data)
    {
        if (isset($data['image'])) {
            $data['image'] = $this->UploadImage($data['image']);

        }
        if (isset($data['icon'])) {
            $data['icon'] = $this->UploadImage($data['icon'], 'icons');

        }

        return $data;
    }
}
