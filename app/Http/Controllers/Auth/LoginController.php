<?php

namespace App\Http\Controllers\Auth;

//use Illuminate\Support\Facades\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Illuminate\Validation\ValidationException;
use Illuminate\Validation\Rule;
use Illuminate\Support\Facades\Hash;
use Auth;
use Session;
use Carbon\Carbon;
use Validator;
use Illuminate\Contracts\Auth\Guard;
use Illuminate\Foundation\Auth\ThrottlesLogins;


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

    use  AuthenticatesUsers;
    //use ThrottlesLogins;

    /**
     * lockoutTime
     *
     * @var
     */
    protected $lockoutTime = 1;

    /**
     * maxLoginAttempts
     *
     * @var
     */

    protected $maxAttempts  = 300;

    protected $decayMinutes = 1;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    protected $redirectTo = '/portal/dashboard';

    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return view('portal.auth.login');
    }

    public function dologin(Request $request)
    {
        $input = [
            $username = $request->username,
            $password = $request->password,
        ];

        $rules = [
            'username' => 'required|min:2|max:30',
            'password' => 'required|min:5|max:50'
        ];

        $validator = $this->validate($request, $rules,
            [
                'username.required' =>trans('auth.ph_email'),
                'password.required' =>trans('auth.ph_password'),
                'password.min' =>trans('auth.password_not_min'),
                'password.alpha_num' => trans('auth.alpha_num'),
            ]
        );

        // If the class is using the ThrottlesLogins trait, we can automatically throttle
        // the login attempts for this application. We'll key this by the username and
        // the IP address of the client making these requests into this application.
        if ($this->hasTooManyLoginAttempts($request)) {
            $this->fireLockoutEvent($request);
            return response()->json(['success' => false, 'message' => $this->sendLockoutResponse($request)]);
        }

        if ($this->attemptLogin($request))
        {
            $user = \Auth::user();
            addUserActivity('User Account',  'User Login ');

            return response()->json(['success' => true,'url' => $this->redirectTo, 'message' => $this->sendLoginResponse($request)]);
        }


        return $this->sendFailedLoginResponse($request);
    }

    protected function attemptLogin(Request $request)
    {
        //dd(Hash::make($request->password));


        $credentials = $request->only('username', 'password');
        $username = $credentials['username'];
        $password = $credentials['password'];

        if (filter_var($username, FILTER_VALIDATE_EMAIL)) {
            $array = ['email' => $username, 'password' => $password, 'status_id' => 1];
        }
        else
        {
            $array = ['username' => $username, 'password' => $password, 'status_id' => 1];
        }


        $bRes  = Auth::attempt($array, $request->remember);


        if ($bRes) {
            // if successful, then redirect to their intended location
            return TRUE;
        }
        // If the login attempt was unsuccessful we will increment the number of attempts
        // to login and redirect the user back to the login form. Of course, when this
        // user surpasses their maximum number of attempts they will get locked out.
        $this->incrementLoginAttempts($request);

        // if unsuccessful, then redirect back to the login with the form data
        $request->session()->put('login_error', trans('auth.failed'));
            throw ValidationException::withMessages(
                [
                    'error' => [trans('auth.failedorusernotactive')],
                ]
            );
    }

}
