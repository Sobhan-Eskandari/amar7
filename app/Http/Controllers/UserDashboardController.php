<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\UpdateUserInfoRequest;
use App\Http\Requests\UpdateUserPasswordRequest;
use App\Lesson;
use App\Photo;
use App\Setting;
use App\Share;
use App\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Session;

class UserDashboardController extends Controller
{
    public function info()
    {
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $count = count($result);
        return view('Dashboard.UserDashboard.Info', compact('user', 'count'));
    }

    public function password()
    {
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $count = count($result);
        return view('Dashboard.UserDashboard.ChangePassword', compact('user', 'count'));
    }

    public function courses()
    {
        $count = 0;
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 1){
                $result[] = $lesson;
            }else{
                $count++;
            }
        }
        $lessons = collect($result);
        return view('Dashboard.UserDashboard.Courses', compact('user', 'lessons', 'count'));
    }

    public function UpdateInfo(UpdateUserInfoRequest $request, $id)
    {
        $user = User::findOrFail($id);
        $input = $request->all();

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

        Session::flash('edited_info', 'اطلاعات شما ویرایش شد');

        return redirect('/user-info');
    }

    public function UpdatePassword(UpdateUserPasswordRequest $request, $id)
    {
        if(Auth::Check()) {
            $input = $request->all();
            $current_password = Auth::User()->password;

            if(Hash::check($input['old_password'], $current_password)) {
                $user = User::findOrFail($id);
                $input['password'] = bcrypt($request->password);
                $user->update($input);
                Session::flash('changed_password', 'رمز عبور شما تغییر کرد');
            }else{
                Session::flash('wrong_password', 'رمز عبور فعلی اشتباه است');
            }
        }
        return redirect('/user-password');
    }

    public function cart()
    {
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $course_categories = CoursesCategories::orderByRaw('RAND()')->take(5)->get();
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $shares = Share::orderByRaw('RAND()')->take(9)->get();
        $count = count($result);
        $lessons = collect($result);
        return view('Dashboard.UserDashboard.Cart', compact('info','lessons','count', 'course_categories', 'shares'));
    }
    public function addToCart(Request $request,$id){
        $lesson = Lesson::findorFail($id);
        $user = Auth::user();
        $lesson->users()->attach($user);
        return redirect('/cart');
    }

    public function removeFromCart($id){
        $lesson = Lesson::findOrFail($id);
        if (Auth::check()){
            $user = Auth::user();
            $lesson->users()->detach(['user_id'=>$user->id]);
        }
        return Redirect::route('cart');
    }

    public function bought(){
        $user = Auth::user();
        foreach ($user->lessons as $lesson){
            $lesson->pivot->bought = 1;
            $lesson->pivot->save();
        }
        return Redirect::route('cart');
    }

    public function sessions($id)
    {
        $user = Auth::user();
        $lessons = $user->lessons;
        $result= [];
        foreach ($lessons as $lesson){
            if($lesson->pivot->bought == 0){
                $result[] = $lesson;
            }
        }
        $count = count($result);

        $lesson = Lesson::findOrFail($id);
        $sessions = $lesson->sessions;

        return view('Dashboard.UserDashboard.Session', compact('user', 'count', 'sessions'));
    }
}
