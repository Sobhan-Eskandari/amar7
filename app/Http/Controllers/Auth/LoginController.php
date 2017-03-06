<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use GuzzleHttp\Client;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;

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
     * Where to redirect users after login / registration.
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
        $this->middleware('guest', ['except' => 'logout']);
    }

    /**
     * Validate the user login request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return void
     */
    protected function validateLogin(Request $request)
    {
        $this->validate($request, [
            $this->username() => 'required', 'password' => 'required', 'g-recaptcha-response' => 'required',
        ],[
            'email.required' => 'وارد کردن ایمیل اجباری است',
            'password.required' => 'وارد کردن رمز عبور اجباری است',
            'g-recaptcha-response.required' => 'زدن تیک من ربات نیستم اجباری است',
        ]);
    }

    public function credentials(Request $request)
    {
        return [
            'email' => $request->email,
            'password' => $request->password,
            'verified' => 1,
        ];
    }

    /**
     *  Over-ridden the login method from the "AuthenticatesUsers" trait
     *  Remember to take care while upgrading laravel
     */
    public function login(Request $request)
    {
        $this->validateLogin($request);

        $token = $request->input('g-recaptcha-response');

        if($token){
            $client = new Client();

            $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                'form_params' => array(
                    'secret'    => '6Ld0ORcUAAAAAFbFjggaz34RERdKbuM_NNggREU4',
                    'response'  => $token
                )
            ]);

            $result = json_decode($response->getBody()->getContents());

            if($result->success){
                if ($this->hasTooManyLoginAttempts($request)) {
                    $this->fireLockoutEvent($request);

                    return $this->sendLockoutResponse($request);
                }

                if ($this->attemptLogin($request)) {
                    return $this->sendLoginResponse($request);
                }

                $this->incrementLoginAttempts($request);

                return $this->sendFailedLoginResponse($request);

            }else{
                return redirect('/');
            }
        }else{
            return redirect('/');
        }

    }
}
