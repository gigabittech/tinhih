<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class InsuranceClaim extends Model
{
    use HasFactory;

    public function appointment()
    {
        return $this->belongsTo(Appointment::class);
    }

}
