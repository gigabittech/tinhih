<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use App\Models\User;
use App\Models\Admin\CommunityMember;
use App\Models\Admin\Provider;
use App\Models\Admin\Client;
use App\Notifications\MailNotification;
use Illuminate\Foundation\Auth\RegistersUsers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class RegisterController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Register Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles the registration of new users as well as their
    | validation and creation. By default this controller uses a trait to
    | provide this functionality without requiring any additional code.
    |
    */

    use RegistersUsers;

    /**
     * Where to redirect users after registration.
     *
     * @var string
     */
    protected $redirectTo = RouteServiceProvider::HOME;

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param array $data
     * @return \Illuminate\Contracts\Validation\Validator
     */protected function validator(array $data)
{
    return Validator::make($data, [
        'name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9][A-Za-z0-9\s]*[A-Za-z0-9]$/'],
        'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
        'phone' => ['required', 'string', 'max:255', 'unique:users'],
        'password' => ['required', 'string', 'min:8', 'confirmed'],
        'first_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9][A-Za-z0-9\s]*[A-Za-z0-9]$/'],
        'last_name' => ['required', 'string', 'max:255', 'regex:/^[A-Za-z0-9][A-Za-z0-9\s]*[A-Za-z0-9]$/'],
        'dob' => ['required', 'date', 'before_or_equal:' . now()->format('Y-m-d')],
    ]);
    
}
    /**
     * Create a new user instance after a valid registration.
     *
     * @param array $data
     * @return \App\Models\User
     */
    protected function create(array $data)
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'phone' => $data['phone'],
            'type' => $data['type'],
            'password' => Hash::make($data['password']),
        ]);


        if ($data['type'] == 'provider') {
            $user->provider()->create($data);

        } elseif ($data['type'] == 'community_member') {
            $user->community_member()->create($data);

        } else {
            $user->client()->create($data);
        }
    //    $user->notify(new MailNotification("Thank you for registering! We are excited to have you on board as a valued customer."));


        return $user;
    }
}
