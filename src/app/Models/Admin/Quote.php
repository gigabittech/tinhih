<?php
namespace App\Models\Admin;

use App\Traits\CommonFunctions;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
class Quote extends Model
{
    use HasFactory;
    use CommonFunctions;
    
    protected $fillable = ['title'];

    public function GetData($data)
    {
        // Process or manipulate the data here as needed
        // You can also perform validation or any other operations

        // Return the processed data or perform any desired actions
        return $data;
    }
}
