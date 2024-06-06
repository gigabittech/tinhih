<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Assessment extends Model
{
    use HasFactory;


    protected $fillable = [
        'appointment_id',
        'diagnosis',
        'is_completed'
    ];
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
