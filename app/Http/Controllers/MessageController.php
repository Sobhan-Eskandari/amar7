<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\ContactUsRequest;
use App\Http\Requests\SendEmailRequest;
use App\Mail\darskhan;
use App\Message;
use App\Setting;
use App\Share;
use GuzzleHttp\Client;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Session;
use Morilog\Jalali\Facades\jDate;

class MessageController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $messages = Message::orderByRaw('created_at desc')->paginate(10);
        foreach ($messages as $message){
            $date = $message->created_at;
            $date = substr($date, 0, strpos( $date,' '));
            $date = str_replace('-','/',$date);
            $message['date'] = $date;
        }
        return view('Dashboard.AdminDashboard.Messages.Index',compact('messages'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        if(Auth::Check()) {
            $user = Auth::user();
            $lessons = $user->lessons;
            $result = [];
            foreach ($lessons as $lesson) {
                if ($lesson->pivot->bought == 0) {
                    $result[] = $lesson;
                }
            }
            $count = count($result);
        }
        $shares = Share::orderByRaw('RAND()')->take(20)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        return view('Main.ContactUs', compact('info', 'course_categories','count', 'shares'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ContactUsRequest $request)
    {
        $token = $request->input('g-recaptcha-response');
        if($token){
            $client = new Client();
            $response = $client->post('https://www.google.com/recaptcha/api/siteverify',[
                'form_params'=>array(
                    'secret' => '6Ld0ORcUAAAAAFbFjggaz34RERdKbuM_NNggREU4',
                    'response' => $token
                )
            ]);
            $result = json_decode($response->getBody()->getContents());
            if($result->success){
                Message::create($request->all());
                Session::flash('send_message','پیام ارسال شد');
                return redirect('contact-us');
            }else{
                Session::flash('robot_message','شاید شما ربات باشید');
                return redirect('contact-us');
            }
        }else{
            return redirect('');
        }

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $message = Message::findOrFail($id);
        $message->read = 1 ;
        $message->save();
        $date = $message->created_at;
        $date = str_replace('-','/',$date);
        $date = substr(strrev($date),strpos($date,' '));
        $date = strrev($date);
        $message['date'] = $date;
        return view('Dashboard.AdminDashboard.Messages.Show',compact('message'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Message::findOrfail($id)->delete();
        Session::flash("deleted_message","پیام پاک شد");
        return redirect('messages');
    }
    public function answerMessage(SendEmailRequest $request){
        $input = $request->all();
        $input['name'] = '';
        Mail::to($input['email'])->send(new Darskhan($input));

        return redirect('/messages');
    }
    public function search(Request $request){
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = "";
        }
        $messages = Message::where('name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        foreach ($messages as $message){
            $date = $message->created_at;
            $date = substr($date, 0, strpos( $date,' '));
            $date = str_replace('-','/',$date);
            $message['date'] = $date;
        }
        return view('Dashboard.AdminDashboard.Messages.Index',compact('messages'));
    }
}
