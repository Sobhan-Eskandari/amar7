<?php

namespace App\Http\Controllers;

use App\Http\Requests\tagsRequest;
use App\Tag;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class Tagscontroller extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.Tags.Index',compact('tags'));
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
    public function store(tagsRequest $request)
    {
        //dd($request->all());
        Tag::create($request->all());
        Session::flash('created_category', 'دسته بندی ساخته شد');
        return redirect('tags');
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
        $tag = Tag::findOrFail($id);
        return view('Dashboard.AdminDashboard.Tags.Edit',compact('tag'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(tagsRequest $request, $id)
    {
        Tag::findOrFail($id)->update($request->all());
        Session::flash("edited_category","دسته بندی ویرایش شد");
        return redirect('tags');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::findOrFail($id);
        if($tag->lessons){
            $tag->lessons()->detach();
        }
        if($tag->wikis){
            $tag->wikis()->detach();
        }
        $tag->delete();
        Session::flash("deleted_category","دسته بندی پاک شد");
        return redirect('tags');
    }
    public function search(Request $request){
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = "";
        }
        $tags = Tag::where('name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.Tags.Index',compact('tags'));
    }
}
