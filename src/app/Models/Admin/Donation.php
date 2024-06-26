<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Donation extends Model
{
    use HasFactory;protected $fillable = [
        'user_id',
        'one_time',
        'recurring',
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

