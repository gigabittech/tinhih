<?php

namespace App\Models\Admin;

use App\Traits\CommonFunctions;
use App\Models\User;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ProviderSchedule extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'provider_id',
        'start_time',
        'end_time',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function appointment()
    {
        return $this->hasMany(Appointment::class);
    }

    public function GetData($data)
    {
        return $data;
    }

}