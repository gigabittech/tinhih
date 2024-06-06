<?php

namespace App\Models\Admin;

use App\Models\User;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ZoomMeeting extends Model
{
    use HasFactory;
    /****************************
     * Property area
     *****************************/
    protected $fillable = [
        'appointment_id',
        'uuid',
        'zoom_id',
        'host_id',
        'host_email',
        'topic',
        'type',
        'status',
        'start_time',
        'duration',
        'timezone',
        'zoom_created_time',
        'start_url',
        'join_url',
        'password',
        'h323_password',
        'pstn_password',
        'encrypted_password',
        'pre_schedule',
    ];

    /****************************
     * Model Relation area
     *****************************/

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    // public function zoom()
    // {
    //     return $this->belongsTo(Appointment::class);
    // }

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

        $arrayData['uuid']=$data->uuid;

        $arrayData['zoom_id']=$data->id;
        $arrayData['host_id']=$data->host_id;
        $arrayData['host_email']=$data->host_email;
        $arrayData['topic']=$data->topic;
        $arrayData['type']=$data->type;
        $arrayData['status']=$data->status;
        $arrayData['start_time']=date('Y-m-d H:i:s', strtotime($data->start_time));
        $arrayData['duration']=$data->duration;
        $arrayData['timezone']=$data->timezone;
        $arrayData['zoom_created_time']=date('Y-m-d H:i:s', strtotime($data->created_at));
        $arrayData['start_url']=$data->start_url;
        $arrayData['join_url']=$data->join_url;
        $arrayData['password']=$data->password;
        $arrayData['h323_password']=$data->h323_password;
        $arrayData['pstn_password']=$data->pstn_password;
        $arrayData['encrypted_password']=$data->encrypted_password;
        $arrayData['pre_schedule']=$data->pre_schedule;
        return $arrayData;
    }

    public function IsZoomMeetingExist($apointmentId)
    {
        $zoomMeeting = ZoomMeeting::where('appointment_id',$apointmentId)->first();

        return $zoomMeeting!=null?true:false;
    }
}