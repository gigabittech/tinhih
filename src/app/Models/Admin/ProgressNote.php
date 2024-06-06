<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProgressNote extends Model
{
    use HasFactory;

    protected $fillable = [
        'appointment_id',
        'note'
    ];
    
    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
