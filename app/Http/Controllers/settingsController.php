<?php

namespace App\Http\Controllers;

use App\Http\Requests\SettingsRequest;
use App\Setting;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;

class settingsController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        if($id = Setting::first()) {
            $info = Setting::findOrFail($id->id);
        }else{
            $info = collect(new Setting);
        }
        return view('Dashboard.AdminDashboard.Settings.Index',compact('info'));
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
    public function store(SettingsRequest $request)
    {
        $input = $request->all();
        if($id = Setting::first()) {
            $info = Setting::whereId($id->id)->get();
            $info2 = Setting::findOrFail($id->id);
        }else{
            $info = collect(new Setting);
            $info2 = new Setting();
        }
//        dd($input);
        if($info->isEmpty()){
            if ($img = $request->file('header_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['header_img'] = $name;
            }
            if ($img = $request->file('thSlider_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['thSlider_img'] = $name;
            }
            if ($img = $request->file('ndSlider_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['ndSlider_img'] = $name;
            }
            if ($img = $request->file('rdSlider_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['rdSlider_img'] = $name;
            }
            if ($img = $request->file('contactUs_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['contactUs_img'] = $name;
            }
            if ($img = $request->file('aboutUs_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['aboutUs_img'] = $name;
            }
            if ($img = $request->file('middle_cover_img')) {
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['middle_cover_img'] = $name;
            }
            Setting::create($input);
            Session::flash('info_add','اطلاعات ثبت شد');
            return redirect('settings');
        }else{
            if ($img = $request->file('header_img')) {
                if (!empty($file = $info2->header_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['header_img'] = $name;
            }
            if ($img = $request->file('thSlider_img')) {
                if (!empty($file = $info2->thSlider_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['thSlider_img'] = $name;
            }
            if ($img = $request->file('ndSlider_img')) {
                if (!empty($file = $info2->ndSlider_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['ndSlider_img'] = $name;
            }
            if ($img = $request->file('rdSlider_img')) {
                if (!empty($file = $info2->rdSlider_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['rdSlider_img'] = $name;
            }
            if ($img = $request->file('contactUs_img')) {
                if (!empty($file = $info2->contactUs_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['contactUs_img'] = $name;
            }
            if ($img = $request->file('aboutUs_img')) {
                if (!empty($file = $info2->aboutUs_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['aboutUs_img'] = $name;
            }

            if ($img = $request->file('middle_cover_img')) {
                if (!empty($file = $info2->middle_cover_img)) {
                    File::delete('siteInfoPhotos/'.$file);
                }
                $name = time()+rand() . $img->getClientOriginalName();
                $img->move('siteInfoPhotos', $name);
                $input['middle_cover_img'] = $name;
            }
//            dd($input);
            $info2->update($input);
            Session::flash('info_edit','اطلاعات ویرایش شد');
            return redirect('settings');
        }
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
