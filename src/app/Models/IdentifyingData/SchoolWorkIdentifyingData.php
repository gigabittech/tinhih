<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SchoolWorkIdentifyingData extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'special_education',
        '_504',
        'current_school',
        'academic_level',
        'degree_earned',
        'degree',
        'current_gpa',
        'advisor',
        'primary_teacher',
        'school_principle',
        'school_telephone',
        'school_fax',
        'school_email',
        'place_of_work',
        'position_held',
        'contact_supervisor',
        'tel',
    ];

    // Client Model Relationship

    public function client()
    {
        return $this->belongsTo(Client::class, 'client_id');

    }

    public function GetData($data)
    {
        return $data;
    }
}
