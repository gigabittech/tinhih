<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\ZoomMeeting;
use Exception;
use Illuminate\Http\Request;
use GuzzleHttp\Client;

class ZoomMeetingController extends Controller
{
    private $apiKey = "WXkpGPkPTa692ruSUUjJA";
    private $appointmentId;
    private $apiSecrete = "0OD03Pi1OdRgXEybsKyNCnDIq2ywuWZF";

    private $modelObject;
    public function __construct()
    {
        $this->modelObject = new ZoomMeeting();
    }

    public function authorizeZoom(Request $request)
    {
        if(!$this->modelObject->IsZoomMeetingExist($request->appointment_id)) {
            session()->put('appointmentId', $request->appointment_id);
            //$this->appointmentId = $request->appointment_id;
            $apiKey = $this->apiKey;
            $redirectUri = route('zoom.handleCallBack'); // Define this route in your web.php

            // return redirect()->away("https://zoom.us/oauth/authorize?response_type=code&client_id={$apiKey}&redirect_uri={$redirectUri}");
            return redirect()->away("https://zoom.us/oauth/authorize?client_id=WXkpGPkPTa692ruSUUjJA&response_type=code&redirect_uri=https%3A%2F%2Ftinhih.com%2Fcallback");
        }
        return redirect()->route('appointment.index')->with([
            'error'=>'Zoom meeting already exist for this appointment!'
        ]);
    }
    public function handleCallBack(Request $request)
    {


            $accessToken = $this->getAccessToken($request);
            $data = $this->createZoomMeeting($accessToken);
            $meetingData = $this->modelObject->GetData($data);
            $meetingData['appointment_id'] = session('appointmentId');
            $meeting= $this->modelObject->create($meetingData);
            dd($meeting);
            return redirect()->route('appointment.index')->with([
                'success'=>'Zoom meeting created successfully !'
            ]);



    }

    public function getAccessToken($request)
    {
        $apiKey =  'YCEbFIT7RsmC8Nqlftcd0A';
        $apiSecret =  'Kfel5TmAcNlq0s5wNDM1Xn5FpJ1l4hbw';

        $client =  new Client();

        $response = $client->post('https://zoom.us/oauth/token', [
            'form_params' => [
                'grant_type' => 'authorization_code',
                'code' => $request->code,
                'redirect_uri' => route('zoom.handleCallBack'), // Must match the redirect URI registered with Zoom
            ],
            'auth' => [
                $this->apiKey, // Your API Key
                $this->apiSecrete, // Your API Secret
            ],
        ]);

        $data = json_decode($response->getBody());
        

        // Store the access token for future API requests

        // You can also store the refresh token and other data if needed
        $refreshToken = $data->refresh_token;
        $expiresIn = $data->expires_in;
        $accessToken = $data->access_token;

        return $accessToken;
    }
    public function createZoomMeeting($accessToken)
    {

        $client = new Client();

        $response = $client->post('https://api.zoom.us/v2/users/me/meetings', [
            'headers' => [
                'Authorization' => 'Bearer ' . $accessToken,
            ],
            'json' => [
                'topic' => 'Appointment with Doctor',
                'start_time' => '2023-09-10T12:00:00Z',
                'duration' => 60, // Meeting duration in minutes
            ],
        ]);

        $data = json_decode($response->getBody());


        return $data;
    }
    function getZoomUserData()
    {

        // Generate a new access token (if needed)
        $accessToken = $this->authenticateZoomApi();

        $client = new Client();

        try {

            $response = $client->get('https://api.zoom.us/v2/users/me', [
                'headers' => [
                    'Authorization' => 'Bearer ' . $accessToken,
                ],
            ]);
            // dd($accessToken);
            if ($response->getStatusCode() === 200) {
                $data = json_decode($response->getBody());

                // Return the Zoom user data
                return $data;
            } else {
                // Handle unexpected response status codes (e.g., 401 Unauthorized)
                return null;
            }
        } catch (Exception $e) {
            // Handle exceptions (e.g., network errors)
            dd($e);
            return null;
        }
    }

}