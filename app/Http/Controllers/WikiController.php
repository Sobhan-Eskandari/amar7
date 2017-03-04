<?php

namespace App\Http\Controllers;

use App\Http\Requests\WikiRequest;
use App\Photo;
use App\Setting;
use App\Wiki;
use App\WikiCategories;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Http\Request;
use Illuminate\Pagination\LengthAwarePaginator;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Storage;

class WikiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $wikis = Wiki::orderByRaw('created_at desc')->paginate(10);
        return view('Dashboard.AdminDashboard.Wiki.Index', compact('wikis'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $wiki_categories = WikiCategories::pluck('name', 'id')->all();
        return view('Dashboard.AdminDashboard.Wiki.Create', compact('wiki_categories'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(WikiRequest $request)
    {
        $input = $request->all();
        $input['user_id'] = Auth::id();

        if($file = $request->file('file')){
            $name = time() . $file->getClientOriginalName();
            $file->move('WikiPDFs', $name);
            $input['file'] = $name;
        }

        $wiki = Wiki::create($input);
        $wiki->wiki_categories()->attach($request->wiki_categories);

        if($file = $request->file('img')){
            $name = time() . $file->getClientOriginalName();
            $photo = Photo::create(['path' => $name]);
            $file->move('WikiPhotos', $name);
            $wiki->photos()->save($photo);
        }

        Session::flash('created_wiki', 'مقاله ساخته شد');
        return redirect('/wiki');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
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
        $info = Setting::findOrFail($row->id);
        $wiki = Wiki::findOrFail($id);
        $wiki->seen++;
        $wiki->save();
//        dd($wiki->wiki_categories);
//        foreach ($wiki->wiki_categories as $wiki){
//            dd($wiki['name']);
//        }
        $wikis = Wiki::orderByRaw('RAND()')->take(4)->get();
        $wiki_categories = WikiCategories::orderByRaw('RAND()')->take(9)->get();
        return view('Main.ShowWiki', compact('wiki', 'wikis', 'info', 'wiki_categories','count'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $wiki = Wiki::findOrFail($id);
        $wiki_categories = WikiCategories::pluck('name', 'id')->all();
        return view('Dashboard.AdminDashboard.Wiki.Edit', compact('wiki', 'wiki_categories'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(WikiRequest $request, $id)
    {
        $input = $request->all();
        $wiki = Wiki::findOrFail($id);
        $wiki->wiki_categories()->sync($request->wiki_categories);

        if($file = $request->file('file')){
            if($wiki->file){
                File::delete('WikiPDFs/' . $wiki->file);
            }
            $name = time() . $file->getClientOriginalName();
            $file->move('WikiPDFs', $name);
            $input['file'] = $name;
        }

        $wiki->update($input);

        $photos = $wiki->photos;

        if($file = $request->file('img')){
            if(count($photos) != 0){
                File::delete('WikiPhotos/' . $photos[0]->path);
                Photo::find($photos[0]->id)->delete();
                $wiki->photos()->detach();
            }
            $name = time() . $file->getClientOriginalName();
            $photo = Photo::create(['path' => $name]);
            $file->move('WikiPhotos', $name);
            $wiki->photos()->save($photo);
        }

        Session::flash("edited_wiki","مقاله ویرایش شد");
        return redirect('/wiki');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $wiki = Wiki::findOrFail($id);
        $wiki->wiki_categories()->detach();
        $wiki->delete();
        Session::flash('deleted_wiki', 'مقاله پاک شد');
        return redirect('/wiki');
    }

    public function SearchWiki(Request $request)
    {
        $input = $request->all();
        if (isset($input['name'])) {
            $query = $input['name'];
        } else {
            $query = session('name');
        }
        $wikis = Wiki::where('title', 'like', "%{$query}%")->
        orWhere('body', 'like', "%{$query}%")->
        orderByRaw('created_at desc')->
        paginate(10);
        return view('Dashboard.AdminDashboard.Wiki.Index', compact('wikis', 'query'));
    }

    public function AllWiki(Request $request)
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
        $row = Setting::first();
        $info = Setting::findOrFail($row->id);
        $wiki_categories = WikiCategories::all();
        $rand_wiki_categories = WikiCategories::orderByRaw('RAND()')->take(5)->get();
        isset($input['query']) ? : $input['query'] = '';

        $wikis = Wiki::where('title', 'like', "%{$input['query']}%")->orderByRaw('created_at desc')->paginate(12);
        if(isset($input['categories'])) {
            $wikis = Wiki::where('title', 'like', "%{$input['query']}%")->orderByRaw('created_at desc')->get();
            $results = [];
            foreach ($wikis as $wiki) {
                for ($i = 0; $i < count($wiki->wiki_categories); $i++) {
                    for($j = 0; $j < count($input['categories']); $j++) {
                        $category = WikiCategories::findOrFail($input['categories'][$j]);
                        if ($wiki->wiki_categories[$i]['name'] == $category['name']) {
                            $results[] = $wiki;
                        }
                    }
                }
            }
            $page = Input::get('page', 1); // Get the current page or default to 1
            $perPage = 12;
            $offset = ($page * $perPage) - $perPage;
            $wikis = new LengthAwarePaginator(array_slice($results, $offset, $perPage, true),
                count($results),
                $perPage,
                $page,
                ['path' => $request->url()]);
        }

        if($request->ajax()){
            return view('Main.LoadWikis', compact('wikis', 'info'))->render();
        }

        return view('Main.AllWiki', compact('wikis', 'info', 'wiki_categories', 'rand_wiki_categories','count'));
    }
}
