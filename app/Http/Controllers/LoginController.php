<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use App\Models\User;
use Socialite;

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
     * Show the application's login form.
     *
     * @return \Illuminate\Http\Response
     */
    public function showLoginForm()
    {
        return view('panel');
    }

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    /**
     * Redirect the user to the Twitch authentication page.
     *
     * @return \Illuminate\Http\Response
     */
    public function redirectToTwitchProvider()
    {
        return Socialite::driver('twitch')->redirect();
    }

    /**
     * Obtain the user information from Twitch.
     *
     * @return \Illuminate\Http\Response
     */
    public function handleTwitchProviderCallback()
    {
        $twitch = Socialite::driver('twitch')->user();
        $user = User::findOrCreateForTwitch($twitch);
        
        $this->guard()->login($user);

        return redirect($this->redirectPath());
    }

    /**
     * The user has logged out of the application.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return mixed
     */
    protected function loggedOut(Request $request)
    {
        return response()->json([
            'message' => 'Successfully logged out.'
        ], 200);
    }
}
