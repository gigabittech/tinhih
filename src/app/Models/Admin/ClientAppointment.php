<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Traits\CommonFunctions;

class ClientAppointment extends Model
{
    use HasFactory;
    use CommonFunctions;
    protected $fillable = [
        'provider_id',
        'client_id',
        'schedule_id',
    ];

    public function provider_schedule()
    {
        return $this->belongsTo(ProviderSchedule::class);
    }

    public function client()
    {
        return $this->belongsTo(Client::class);
    }

    public function provider()
    {
        return $this->belongsTo(Provider::class);
    }

    public function GetData($data)
    {
        return $data;
    }
}
