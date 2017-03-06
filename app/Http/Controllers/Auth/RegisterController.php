<?php

namespace App\Http\Controllers\Auth;
use DB;
use Illuminate\Support\Facades\Session;
use Mail;
use App\User;
use GuzzleHttp\Client;
use Validator;
use Illuminate\Http\Request;
use App\Mail\EmailVerification;
use App\Http\Controllers\Controller;
use Illuminate\Foundation\Auth\RegistersUsers;

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
        $this->middleware('guest');
    }

    /**
     * Get a validator for an incoming registration request.
     *
     * @param  array  $data
     * @return \Illuminate\Contracts\Validation\Validator
     */
    protected function validator(array $data)
    {
        return Validator::make($data, [
            'first_name' => 'required|max:255',
            'last_name' => 'required|max:255',
            'email' => 'required|email|unique:users,email',
            'password'=>'required|min:8',
            'g-recaptcha-response' => 'required',
        ],[
            'first_name.required' => 'وارد کردن نام اجباری است',
            'last_name.required' => 'وارد کردن نام خانوادگی اجباری است',
            'email.required' => 'وارد کردن ایمیل اجباری است',
            'password.required' => 'وارد کردن پسورد اجباری است',
            'g-recaptcha-response.required' => 'زدن تیک من ربات نیستم اجباری است',
            'password.min' => 'حداقل طول پسورد باید 8 کاراکتر باشد',
            'first_name.max' => 'نام طولانی تر از حد مجاز است',
            'last_name.max' => 'نام خانوادگی طولانی تر از حد مجاز است',
            'email.email' => 'ایمیل وارد شده معتبر نیست',
            'email.unique' => 'ایمیل وارد شده قبلا در سیستم ثبت شده است',
        ]);
    }

    /**
     * Create a new user instance after a valid registration.
     *
     * @param  array  $data
     * @return User
     */
    protected function create(array $data)
    {
        Session::flash('email', 'لطفا ایمیل خود را برای تایید عضویت بررسی نمایید');
        return User::create([
            'first_name' => $data['first_name'],
            'last_name' => $data['last_name'],
            'email' => $data['email'],
            'password' => bcrypt($data['password']),
            'email_token' => str_random(50),
        ]);
    }

    /**
     *  Over-ridden the register method from the "RegistersUsers" trait
     *  Remember to take care while upgrading laravel
     */
    public function register(Request $request)
    {
        // Laravel validation
        $validator = $this->validator($request->all());
        if ($validator->fails())
        {
            $this->throwValidationException($request, $validator);
        }
        // Using database transactions is useful here because stuff happening is actually a transaction
        // I don't know what I said in the last line! Weird!
        DB::beginTransaction();
        try
        {
            $token = $request->input('g-recaptcha-response');
            //dd($token);
            if($token){
                $client = new Client();
                //dd($client);
                $response = $client->post('https://www.google.com/recaptcha/api/siteverify', [
                    'form_params' => array(
                        'secret'    => '6Ld0ORcUAAAAAFbFjggaz34RERdKbuM_NNggREU4',
                        'response'  => $token
                    )
                ]);
                //dd($response);
                $result = json_decode($response->getBody()->getContents());
                if($result->success){
                    //dd($result->success);
                    //dd($request->all());
                    $user = $this->create($request->all());
                    // After creating the user send an email with the random token generated in the create method above
                    $email = new EmailVerification(new User(['email_token' => $user->email_token]));
                    Mail::to($user->email)->send($email);
                    DB::commit();
                    return back();
                }else{
                    return redirect('/');
                }
            }
        }
        catch(Exception $e)
        {
            DB::rollback();
            return back();
        }
    }

    // Get the user who has the same token and change his/her status to verified i.e. 1
    public function verify($token)
    {
        // The verified method has been added to the user model and chained here
        // for better readability
        User::where('email_token',$token)->firstOrFail()->verified();
        return redirect('/');
    }
}
