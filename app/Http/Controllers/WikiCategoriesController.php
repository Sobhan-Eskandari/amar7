<?php

namespace App\Http\Controllers;

use App\Http\Requests\WikiCategoriesRequest;
use App\WikiCategories;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;
use phpDocumentor\Reflection\DocBlock\Tags\See;

class WikiCategoriesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = WikiCategories::orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.WikiCategories.Index', compact('categories'));
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
    public function store(WikiCategoriesRequest $request)
    {
        WikiCategories::create($request->all());
        Session::flash('created_category', 'دسته بندی ساخته شد');
        return redirect('/wiki-categories');
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
        $category = WikiCategories::findOrFail($id);
        return view('Dashboard.AdminDashboard.WikiCategories.Edit', compact('category'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WikiCategoriesRequest $request, $id)
    {
        WikiCategories::findOrFail($id)->update($request->all());
        Session::flash("edited_category","دسته بندی ویرایش شد");
        return redirect('/wiki-categories');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $category = WikiCategories::findOrFail($id);
        if($category->wikis){
            $category->wikis()->detach();
        }
        $category->delete();
        Session::flash("deleted_category","دسته بندی پاک شد");
        return redirect('/wiki-categories');
    }

    public function SearchCategories(Request $request)
    {
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = session('name');
        }
        $categories = WikiCategories::where('name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.WikiCategories.Index', compact('categories', 'query'));
    }
}
