<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Admin\Profile;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Laravel\Socialite\Facades\Socialite;

class LoginController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
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
        $this->middleware('guest')->except('logout');
    }

    public function logout(Request $request)
    {
        Auth::logout();
        return redirect()->route('login');
    }
    // Google login
    public function redirectToGoogle()
    {

        return Socialite::driver('google')->redirect();
    }

    // Google callback
    public function handleGoogleCallback()
    {
        $user = Socialite::driver('google')->user();

        $this->_registerOrLoginUser($user,'google');

        // Return home after login
        return redirect()->route('dashboard.index');
    }

    // Facebook login
    public function redirectToFacebook()
    {
        return Socialite::driver('facebook')->redirect();
    }

    // Facebook callback
    public function handleFacebookCallback()
    {
        $user = Socialite::driver('facebook')->user();

        $this->_registerOrLoginUser($user,'facebook');

        // Return home after login
        return redirect()->route('dashboard.index');
    }

    // Github login
    public function redirectToGithub()
    {
        return Socialite::driver('github')->redirect();
    }

    // Github callback
    public function handleGithubCallback()
    {
        $user = Socialite::driver('github')->user();

        $this->_registerOrLoginUser($user,'github');

        // Return home after login
        return redirect()->route('dashboard.index');
    }

    protected function _registerOrLoginUser($data,$provider)
    {

        $user = User::where('social_login_user_id', '=', $data->user['id'])->orWhere('email',$data->email)->first();
        if (!$user) {
            $userArray = [];
            $userArray['name'] = $data->name;
            $userArray['email'] = $data->email;
            $userArray ['social_login_provider_name'] = $provider;
            $userArray ['social_login_user_id'] = $data->user['id'];
            $userArray['password'] = encrypt('');
            //    $user->provider_id = $data->id;
            //    $user->avatar = $data->avatar;

            $user =  User::create($userArray);
            if($user)
            {

                $user->client()->create($userArray);
            }

        }

        Auth::login($user);
    }
}
