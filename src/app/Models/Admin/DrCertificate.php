<?php

namespace App\Models\Admin;

use App\Traits\CommonFunctions;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DrCertificate extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'provider_id',
        'certification_id',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class, 'provider_id');
    }

    public function certification()
    {
        return $this->belongsTo(Certification::class, 'certification_id');
    }
    
    public function GetData($data)
    {
        return $data;
    }

}
