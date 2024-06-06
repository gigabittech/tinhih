<?php

namespace App\Models\Admin;

use App\Models\User;
use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrSpecialization extends Model
{
    use HasFactory;
    use CommonFunctions;    
    protected $table = 'dr_specializations';
    protected $fillable = [
        'provider_id',
        'specialization_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function specialization()
    {
        return $this->belongsTo(Specialization::class);
    }

    public function GetData($data)
    {
        return $data;
    }
}
