<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class PrintfulProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'product_id',
    ];



    public function GetData($data)
    {
        return $data;
    }


}
