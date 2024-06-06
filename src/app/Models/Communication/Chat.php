<?php

namespace App\Models\Communication;

use App\Models\Admin\Appointment;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'sender_id',
        'receiver_id',
        'message',
        'appointment_id'
    ];


    public function chat()
	{
		return $this->hasMany(Chat::class);
	}

    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }

    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }


    public function GetData($data)
    {

        return $data;
    }



}
