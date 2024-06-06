<?php

namespace App\Models\IdentifyingData;

use App\Models\Admin\Client;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DFSCustody extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'dfs_custody_of_your_children',
        'dfs_caseworker',
        'dfs_tel',
        'dfs_email',
        'dfs_location',
        'child_probation_officer',
        'child_probation_officer_tel',
        'juvenile_Justice_Custody_of_your_child'
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
