<?php

namespace App\Http\Controllers;

use App\CoursesCategories;
use App\Http\Requests\coursesCategoriesRequest;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Session;
use SebastianBergmann\CodeCoverage\Report\Html\Dashboard;

class CoursesCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $coursesCategories = CoursesCategories::orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.CoursesCategories.Index',compact('coursesCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(coursesCategoriesRequest $request)
    {
        //dd($request->all());
        CoursesCategories::create($request->all());
        Session::flash('created_category', 'دسته بندی ساخته شد');
        return redirect('courses-categories');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $courseCategory = CoursesCategories::findOrFail($id);
        return view('Dashboard.AdminDashboard.CoursesCategories.Edit',compact('courseCategory'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(coursesCategoriesRequest $request, $id)
    {
        CoursesCategories::findOrFail($id)->update($request->all());
        Session::flash("edited_category","دسته بندی ویرایش شد");
        return redirect('/courses-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = CoursesCategories::findOrFail($id);
        if($category->lessons){
            $category->lessons()->detach();
        }
        $category->delete();
        Session::flash("deleted_category","دسته بندی پاک شد");
        return redirect('/courses-categories');
    }
    public function search(Request $request){
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = "";
        }
        $coursesCategories = CoursesCategories::where('name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.CoursesCategories.Index',compact('coursesCategories'));
    }
}
