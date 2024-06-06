<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Certification extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'title'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function GetData($data)
    {
        return $data;
    }
   
}
