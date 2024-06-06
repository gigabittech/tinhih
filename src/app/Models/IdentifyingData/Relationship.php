<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Relationship extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'best_describes_your_or_your_childs_relationship',
        'what_describes_your_current_relationships'
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
