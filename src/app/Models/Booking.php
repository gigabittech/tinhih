<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Booking extends Model
{
    use HasFactory;
    /****************************
     * Property area
     *****************************/
    protected $fillable = [

        'airplane_id',
        'airplane_schedule_id',
        'user_id',
        'status',
        'price',
        'booking_date',
        'start_time',
        'end_time',
        'note'
    ];

    /****************************
     * Model Relation area
     *****************************/
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function airplane()
    {
        return $this->belongsTo(Airplane::class, 'airplane_id');
    }

    public function schedule()
    {
        return $this->belongsTo(AirplaneSchedule::class, 'airplane_schedule_id');
    }
    /****************************
     * Public Methods area
     *****************************/

    /***
     * Method to get data.
     * @param $data
     * @return
     */

    public function GetData($data)
    {
        return $data;
    }

    public function isBookingExist($bookingDate,$scheduleId)
    {
        if ($this->GetBooking($bookingDate,$scheduleId)!=null)
        {
            return true;
        }
        return false;
    }

    public function GetBooking($bookingDate,$scheduleId)
    {
        return Booking::whereDate('booking_date',$bookingDate)->where('airplane_schedule_id',$scheduleId)->first();
    }

    /****************************
     * Public Methods area
     *****************************/
}
