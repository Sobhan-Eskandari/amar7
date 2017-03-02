<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\editLessonRequest;
use App\Http\Requests\LessonsRequest;
use App\Lesson;
use App\Photo;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class LessonController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $lessons = Lesson::orderByRaw('created_at desc')->paginate(10);
        foreach ($lessons as $lesson){
            $date = $lesson->created_at;
            $date = substr($date, 0, strpos( $date,' '));
            $date = str_replace('-','/',$date);
            $lesson['date'] = $date;
        }
        return view('Dashboard.AdminDashboard.Courses.Index',compact('lessons'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = CoursesCategories::pluck('name','id')->all();;
        return view('Dashboard.AdminDashboard.Courses.CreateLesson',compact('categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(LessonsRequest $request)
    {
        $input = $request->all();
        if($input['cost'] == ''){
            $input['cost'] = NULL;
        }
        if(Auth::check()){
            $user = Auth::user();
            $input['user_id'] = $user->id;
        }
        $input['media'] = implode(",",$request->media);
        $lesson = Lesson::create($input);
        $lesson->categories()->attach($request->categories);
        if($file = $request->file('lesson_img')){
            $name = time().$file->getClientOriginalName();
            $file->move('lessonPhoto',$name);
            $photo = Photo::create(['path' => $name]);
        }
        $lesson->photo()->save($photo);
        Session::flash('created_lesson','درس ساخته شد');
        return redirect('lessons');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $lesson = Lesson::findOrFail($id);
        $lesson->seen++;
        $lesson->save();
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

        $lessons = Lesson::orderByRaw('RAND()')->take(4)->get();
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(5)->get();
        foreach (explode(',', $lesson->media) as $media){ $lesson[$media] = 1; }
        return view('Main.ShowCourse', compact('lesson', 'lessons', 'hasUser', 'course_categories','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $lesson = Lesson::findOrFail($id);
        $categories = CoursesCategories::pluck('name','id')->all();
        $media = explode(',',$lesson->media);
        return view('Dashboard.AdminDashboard.Courses.EditLesson',compact('lesson','categories','media'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(editLessonRequest $request, $id)
    {
        $lesson = Lesson::findorFail($id);
        $input = $request->all();
        if($input['cost'] == ''){
            $input['cost'] = NULL;
        }
        $input['media'] = implode(",",$request->media);
        $lesson->update($input);
        $lesson->categories()->sync($request->categories);
        if($file = $request->file('lesson_img')){
            if(count($photo = $lesson->photo)!=0){
                File::delete('lessonPhoto/'.$photo[0]->path);
                $photo->find($photo[0]->id)->delete();
                $lesson->photo()->detach();
            }
            $name = time().$file->getClientOriginalName();
            $file->move('lessonPhoto',$name);
            $photo = Photo::create(['path' => $name]);
            $lesson->photo()->save($photo);
        }
        Session::flash('edited_lesson','درس ویرایش شد');
        return redirect('lessons');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lesson = Lesson::findorFail($id);
        $lesson->categories()->detach();
        if($sessions = $lesson->sessions){
            foreach($sessions as $session){
                if (!empty($file = $session->session_file)) {
                    File::delete('zipFiles/'.$file);
                }
                $session->delete();
            }
        }
        if(count($photo = $lesson->photo) != 0){

            File::delete('lessonPhoto/'.$photo[0]->path);
            $photo->find($photo[0]->id)->delete();
            $lesson->photo()->detach();
        }
        $lesson->delete();
        return redirect('lessons');

    }
    public function search(Request $request){
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = "";
        }
        $lessons = Lesson::where('lesson_name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        foreach ($lessons as $lesson){
            $date = $lesson->created_at;
            $date = substr($date, 0, strpos( $date,' '));
            $date = str_replace('-','/',$date);
            $lesson['date'] = $date;
        }
        return view('Dashboard.AdminDashboard.Courses.Index',compact('lessons'));
    }
}
