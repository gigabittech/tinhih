<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Admin\Appointment;
use App\Models\Admin\Provider;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Admin\Client;
use App\Models\Admin\CommunityMember;
use App\Models\Admin\Quote;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cache;

class DashboardController extends Controller
{
    public function index()
    {

        $provider_count = Provider::count();
        // $client_count = Client::count();
        $client_count = User::where('type', 'client')->count();
        $appointment_count = Appointment::count();

        $desiredTimeZone = 'America/New_York';
        $now = Carbon::now($desiredTimeZone);
        $dayOfYear = $now->dayOfYear;
        $todayDate = $now->format('Y-m-d');
        $currentTime = $now->format('H:i:s');
        $availableIds = Quote::pluck('id')->all();

        if (!empty($availableIds)) {
            $Quote_Count = Quote::whereIn('id', $availableIds)->inRandomOrder()->first();

            if (!$Quote_Count) {
                // Handle the case where no quotes are found
                $Quote_Count = "No quotes available.";
            }
        } else {
            $Quote_Count = "No quotes available.";
        }


        // Now $Quote_Count will contain the quote with the randomly generated ID or an error message.



        // Retrieve the authenticated user's client data
        $user = auth()->user();
        $joiningDays = null;

        if ($user) {
            $joinDate = $user->created_at;
            $joiningDays = $joinDate->diffInDays($now);
        }

        return view('admin.pages.dashboard', compact('provider_count', 'appointment_count', 'client_count', 'Quote_Count', 'joiningDays'));

    }

    public function video()
    {
        return view('admin.pages.videos.index');

    }

}