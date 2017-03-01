<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\EditSessionRequest;
use App\Http\Requests\SessionRequest;
use App\Lesson;
use App\Session;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;

class SessionController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create($id)
    {
        $lesson = Lesson::findOrFail($id);
        $sessions = $lesson->sessions()->paginate(10);
        foreach ($sessions as $session){
            $date = $session->created_at;
            $date = substr($date, 0, strpos( $date,' '));
            $date = str_replace('-','/',$date);
            $session['date'] = $date;
        }
        return view('Dashboard.AdminDashboard.Courses.CreateSession',compact('lesson','sessions'));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(SessionRequest $request,$id)
    {
        $input = $request->all();
        $lesson = Lesson::findOrFail($id);
        if($zip = $request->file('session_file')){
            $name = time().$zip->getClientOriginalName();
            $zip->move('zipFiles',$name);
            $input['session_file'] = $name;
        }
        $lesson->sessions()->save(new Session($input));
        \Illuminate\Support\Facades\Session::flash('created_session','جلسه ساخته شد');
        return Redirect::route('sessions.create',$lesson->id);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $session = Session::findOrFail($id);
        $lesson = $session->lesson;
        $sessions = $lesson->sessions;
        if(Auth::Check()) {
            $user = Auth::user();
            $lessons = $user->lessons;
            $result = [];
            foreach ($lessons as $Lesson) {
                if ($Lesson->pivot->bought == 0) {
                    $result[] = $lesson;
                }
            }
            $count = count($result);
            $hasUser = 1;
            foreach ($user->lessons as $userLesson) {
                if ($userLesson->lesson_name == $lesson->lesson_name) {
                    $hasUser = 0;
                    $lesson = $userLesson;
                    break;
                }
            }
        }
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(5)->get();
        $lessons = Lesson::orderByRaw('RAND()')->take(4)->get();
        foreach (explode(',', $lesson->media) as $media){ $lesson[$media] = 1; }
        return view('Main.ShowSession',compact('session','lesson','sessions','hasUser','lessons','count','course_categories'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($session_id,$id)
    {
        $lesson = Lesson::findOrFail($id);
        $session = Session::findOrFail($session_id);
        return view('Dashboard.AdminDashboard.Courses.EditSession',compact('lesson','session'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(EditSessionRequest $request,$session_id,$id  )
    {
        $input = $request->all();
        $lesson = Lesson::findOrFail($id);
        $session = Session::findOrFail($session_id);
        if ($zip = $request->file('session_file')) {
            if (!empty($file = $session->session_file)) {
                File::delete('zipFiles/'.$file);
            }
            $name = time() . $zip->getClientOriginalName();
            $zip->move('zipFiles', $name);
            $input['session_file'] = $name;
        }
        $session->update($input);
        \Illuminate\Support\Facades\Session::flash('edited_lesson','جلسه ویرایش شد');
        return Redirect::route('sessions.create',$lesson->id);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($session_id,$id)
    {
        $session = Session::findOrFail($session_id);
        $lesson = Lesson::findOrFail($id);
        File::delete('zipFiles/'.$session->session_file);
        $session->delete();
        \Illuminate\Support\Facades\Session::flash('deleted_lesson','جلسه حذف شد');
        return Redirect::route('sessions.create',$lesson->id);
    }
}
