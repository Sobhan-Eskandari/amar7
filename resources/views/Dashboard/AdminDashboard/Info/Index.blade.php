@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | اطلاعات ادمین
@endsection

@section('top-includes')
    <link href="../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../css/creatPost.css" rel="stylesheet" type="text/css" />
    <link href="../css/settings.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="../js/ckeditor.js"></script>

    <link rel="stylesheet" type="text/css" href="css/user_info.css">

    <style>
        .uploadImageBtn{
            background-color: #242832;
            color: white;
            border-radius: 0px;
            border: transparent;
            margin: 5px 30px;
            padding: 15px 25px;
            width: 45%;
            height: 40px;
            text-align: right;
        }
        select{
            width: 90%;
            direction: rtl;
        }
        .fileUpload {
            position: relative;
            overflow: hidden;
            margin: 0px 10px;
        }
        .fileUpload input.upload {
            position: absolute;
            top: 0;
            right: 0;
            margin: 0;
            padding: 0;
            font-size: 20px;
            cursor: pointer;
            opacity: 0;
            filter: alpha(opacity=0);
        }

        .inputs{
            display: flex;
        }

    </style>
@endsection

@section('content')

    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12" style="padding-left: 45%; padding-right: 5%;">
                @if(count($errors) > 0)
                    <div class="alert alert-danger pull-right" style="width:200px;position:absolute;margin-left: 60%; margin-right: 13%; margin-top: 3%">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('edited_admin'))
                    <div class="alert alert-warning pull-right" style="width: 200px;position:absolute;margin-left: 70%; margin-right: 13%; margin-top: 3%; padding-bottom: 0;">
                        <p>{{ session('edited_admin') }}</p>
                    </div>
                @endif
                <div class="container" id="user_info_main">
                    {!! Form::model($user, ['method' => 'PUT', 'action' => ['SiteController@updateAdminInfo', $user->id], 'files' => true]) !!}
                    <div class="row">
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <h5>نام خانوادگی</h5>
                            {!! Form::text('last_name', null, ['required' => 'required', 'tabindex' => '2']) !!}
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <h5>نام </h5>
                            {!! Form::text('first_name', null, ['required' => 'required', 'tabindex' => '1']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <h5>جنسیت</h5>
                            {!! Form::select('gender', ['1' => 'مرد', '0' => 'زن'], null, ['style'=>'height:40px','class'=>'pull-right','tabindex' => '4']) !!}
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <h5>ایمیل </h5>
                            {!! Form::text('email', null, ['required' => 'required', 'tabindex'=>'3']) !!}
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <h5>شغل</h5>
                            {!! Form::text('occupation', null, ['tabindex'=>'6']) !!}
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <h5>موبایل </h5>
                            {!! Form::text('cellphone', null, ['tabindex'=>'5']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <h5>تکرار رمزعبور جدید</h5>
                            {!! Form::password('password_confirmation', ['class'=>'form-control', 'tabindex'=>'8']) !!}
                        </div>
                        <div class="col-lg-5 col-sm-6">
                            <h5>رمز عبور جدید </h5>
                            {!! Form::password('password', ['class'=>'form-control', 'tabindex'=>'7']) !!}
                        </div>
                    </div>

                    <div class="row">
                        <div class="col-lg-5 col-sm-6  pull-right">
                            <h5>  تغییر عکس پروفایل </h5>
                            <div class="inputs">
                                <div style="margin-right:0px; width: 35%;" class="fileUpload uploadImageBtn pull-right">
                                    <p style="margin-right: 0px; margin-top: -6px;">آپلود عکس +</p>
                                    <input name="img" id="uploaduserImg" type="file" class="upload" />
                                </div>
                                <input style="margin-top: 0px" id="userUploadPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <br><img style="width: 80px;height: 80px; border-radius: 50px" src="UsersPhotos/{{ count($user->photos) != 0 ? $user->photos['0']['path'] : 'icone.png' }}">
                        </div>
                    </div>
                    <button type="submit" style="margin-right: 0px" class="pull-right" id="save">ثبت</button>

                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

@endsection

@section('adminInfo')
    active
@endsection

@section('down-includes')
    <script src="js/managementAddShop.js"></script>
    <script src="js/uploadfiles.js"></script>

    <script>
        document.getElementById("uploaduserImg").onchange = function () {
            document.getElementById("userUploadPlace").value = this.value;
        };
    </script>
@endsection