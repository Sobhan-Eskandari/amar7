<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\AdminUpdateRequest;
use App\Lesson;
use App\Photo;
use App\Session;
use App\Setting;
use App\Share;
use App\User;
use App\Wiki;
use App\WikiCategories;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Kryptonit3\Counter\Counter;

class SiteController extends Controller
{
    public function index(){
        if(Auth::Check()){
            $user = Auth::user();
            $lessons = $user->lessons;
            $result= [];
            foreach ($lessons as $lesson){
                if($lesson->pivot->bought == 0){
                    $result[] = $lesson;
                }
            }
            $count = count($result);
        }
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        $wikis = Wiki::orderByRaw('created_at desc')->take(4)->get();
        $lessons = Lesson::orderByRaw('created_at desc')->take(8)->get();
        return view('Main.Index', compact('info', 'wikis', 'lessons', 'course_categories','count', 'shares'));
    }

    public function AboutUs()
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
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        return view('Main.AboutUs', compact('info', 'course_categories','count', 'shares'));
    }

    public function AllCourses(Request $request)
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

        $input = $request->all();
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::all();
        $rand_course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        isset($input['query']) ? : $input['query'] = '';
        isset($input['kind'][0]) ? : $input['kind'][0] = '';
        isset($input['kind'][1]) ? : $input['kind'][1] = '';
        isset($input['kind'][2]) ? : $input['kind'][2] = '';
        isset($input['kind'][3]) ? : $input['kind'][3] = '';

        if(isset($input['amount']) && $input['amount'] == "free"){
            $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
            Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
            Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
            WhereNull('cost')->orderByRaw('created_at desc')->
            paginate(12);
        }
        if(isset($input['amount']) && $input['amount'] == "not_free"){
            $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
            Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
            Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
            whereNotNull('cost')->orderByRaw('created_at desc')->
            paginate(12);
        }
        if(isset($input['amount']) && $input['amount'] == "all"){
            $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
            Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
            Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
            orderByRaw('created_at desc')->
            paginate(12);
        }
        if(!isset($input['amount'])){
            $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
            Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
            Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
            orderByRaw('created_at desc')->
            paginate(12);
        }

        if(isset($input['categories'])) {
            if(isset($input['amount']) && $input['amount'] == "free"){
                $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
                Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
                Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
                WhereNull('cost')->orderByRaw('created_at desc')->
                get();
            }
            if(isset($input['amount']) && $input['amount'] == "not_free"){
                $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
                Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
                Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
                whereNotNull('cost')->orderByRaw('created_at desc')->
                get();
            }
            if(isset($input['amount']) && $input['amount'] == "all"){
                $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
                Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
                Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
                orderByRaw('created_at desc')->
                get();
            }
            if(!isset($input['amount'])){
                $lessons = Lesson::where('lesson_name', 'like', "%{$input['query']}%")->
                Where('media', 'like', "%{$input['kind'][0]}%")->Where('media', 'like', "%{$input['kind'][1]}%")->
                Where('media', 'like', "%{$input['kind'][2]}%")->Where('media', 'like', "%{$input['kind'][3]}%")->
                orderByRaw('created_at desc')->
                get();
            }
            $results = [];
            foreach ($lessons as $lesson) {
                for ($i = 0; $i < count($lesson->categories); $i++) {
                    for($j = 0; $j < count($input['categories']); $j++) {
                        $category = CoursesCategories::findOrFail($input['categories'][$j]);
                        if ($lesson->categories[$i]['name'] == $category['name']) {
                            $results[] = $lesson;
                        }
                    }
                }
            }
            $page = Input::get('page', 1); // Get the current page or default to 1
            $perPage = 12;
            $offset = ($page * $perPage) - $perPage;
            $lessons = new LengthAwarePaginator(array_slice($results, $offset, $perPage, true),
                count($results),
                $perPage,
                $page,
                ['path' => $request->url()]);
        }
        if($request->ajax()){
            return view('Main.LoadCourses', compact('info', 'lessons'))->render();
        }

        return view('Main.AllCourses', compact('info', 'lessons', 'course_categories', 'rand_course_categories','count', 'shares'));
    }

    public function search(Request $request){
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
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = "";
        }
        $lessons = Lesson::where('lesson_name','like',"%{$query}%")->orderByRaw('created_at desc')->get();
        $sessions = Wiki::where('title','like',"%{$query}%")->orderByRaw('created_at desc')->get();
        $searches =  $lessons->merge($sessions);
        return view('Main.SearchResults', compact('info','searches', 'course_categories','count', 'shares'));
    }

    public function adminInfo(){
        $user = Auth::user();
        return view('Dashboard.AdminDashboard.Info.Index', compact('user'));
    }

    public function updateAdminInfo(AdminUpdateRequest $request, $id){
        $user = User::findOrFail($id);
        if(trim($request->password) == ''){
            $input = $request->except('password');
        }else{
            $input = $request->all();
            $input['password'] = bcrypt($request->password);
        }

        $photos = $user->photos;

        if($file = $request->file('img')){
            if(count($photos) != 0){
                File::delete('UsersPhotos/' . $photos[0]->path);
                Photo::find($photos[0]->id)->delete();
                $user->photos()->detach();
            }
            $name = time() . $file->getClientOriginalName();
            $photo = Photo::create(['path' => $name]);
            $file->move('UsersPhotos', $name);
            $user->photos()->save($photo);
        }

        $user->update($input);

        \Illuminate\Support\Facades\Session::flash('edited_admin', 'اطلاعات شما ویرایش شد');

        return redirect('/admin-info');
    }

    public function CourseCategory($id)
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
        $row = Setting::first();
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        $category = CoursesCategories::findOrFail($id);
        $lessons = Lesson::all();
        $results = [];
        foreach ($lessons as $lesson) {
            for ($i = 0; $i < count($lesson->categories); $i++) {
                if ($lesson->categories[$i]['name'] == $category['name']) {
                    $results[] = $lesson;
                    break;
                }
            }
        }
        $searches = collect($results);
        return view('Main.SearchResults', compact('info','searches', 'course_categories','count', 'shares'));
    }

    public function WikiCategory($id)
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
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(9)->get();
        $category = WikiCategories::findOrFail($id);
        $wikis = Wiki::all();
        $results = [];
        foreach ($wikis as $wiki) {
            for ($i = 0; $i < count($wiki->wiki_categories); $i++) {
                if ($wiki->wiki_categories[$i]['name'] == $category['name']) {
                    $results[] = $wiki;
                    break;
                }
            }
        }
        $searches = collect($results);
        return view('Main.SearchResults', compact('info','searches', 'course_categories','count', 'shares'));
    }
}
