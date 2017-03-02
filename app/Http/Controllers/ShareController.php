<?php

namespace App\Http\Controllers;

use App\Http\Requests\ShareRequest;
use App\Share;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Session;

class ShareController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shares = Share::orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.Share.Index', compact('shares'));
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
    public function store(ShareRequest $request)
    {
        Share::create($request->all());
        Session::flash('created_share', 'پیوند ساخته شد');
        return redirect('/share');
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
        $share = Share::findOrFail($id);
        return view('Dashboard.AdminDashboard.Share.Edit', compact('share'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(ShareRequest $request, $id)
    {
        Share::findOrFail($id)->update($request->all());
        Session::flash("edited_share","پیوند ویرایش شد");
        return redirect('/share');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        Share::findOrFail($id)->delete();
        Session::flash("deleted_share","پیوند پاک شد");
        return redirect('/share');
    }

    public function SearchShares(Request $request)
    {
        $input = $request->all();
        if(isset($input['name'])){
            $query = $input['name'];
        }else{
            $query = session('name');
        }
        $shares = Share::where('name','like',"%{$query}%")->orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.Share.Index', compact('shares', 'query'));
    }
}
