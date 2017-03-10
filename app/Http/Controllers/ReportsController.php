<?php

namespace App\Http\Controllers;

use App\Lesson;
use App\User;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Input;
use Morilog\Jalali\Facades\jDate;

class ReportsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $bought = collect();
        foreach (Lesson::all() as $lesson){
            foreach ($lesson->users as $user){
                if($user->role_id==2 && $user->pivot->bought==1){
                    $bought->push(['user'=>$user->FullName,'lesson'=>$lesson->lesson_name,'cost'=>$lesson->cost,'sort'=>jDate::forge($user->pivot->bought_time),'time'=>$user->pivot->bought_time]);
                }
            }
        }

        $collection = $bought->sortByDesc('sort');
        $page = Input::get('page', 1); // Get the current page or default to 1
        $perPage = 10;
        $offset = ($page * $perPage) - $perPage;
        $paginate = new LengthAwarePaginator(array_slice($collection->toArray(), $offset, $perPage, true),
            count($collection->toArray()),
            $perPage,
            $page,
            ['path' => $request->url()]);
        return view('Dashboard.AdminDashboard.Reports.index',compact('paginate'));
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
    public function store(Request $request)
    {
        //
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
        //
    }
}
