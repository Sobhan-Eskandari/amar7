@extends('layouts.DarskhanUser')

@section('title')
    موسسه دانش آماری | اطلاعات {{ \Illuminate\Support\Facades\Auth::user()->full_name }}
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/user_dashboard_sidebar.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">
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
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9 col-9">

                @if(count($errors) > 0)
                    <div class="alert alert-danger pull-right" style="width:200px;position:absolute;margin-left: 60%; margin-right: 13%; margin-top: 3%">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('edited_info'))
                    <div class="alert alert-warning pull-right" style="width: 200px;position:absolute;margin-left: 70%; margin-right: 13%; margin-top: 3%; padding-bottom: 0;">
                        <p>{{ session('edited_info') }}</p>
                    </div>
                @endif

                <div class="container" id="user_info_main">
                    {!! Form::model($user, ['method' => 'PUT', 'action' => ['UserDashboardController@UpdateInfo', $user->id], 'files' => true]) !!}
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-1">
                                <h5>نام خانوادگی</h5>
                                {!! Form::text('last_name', null, ['required' => 'required', 'tabindex' => '2']) !!}
                            </div>
                            <div class="col-lg-5 col-sm-6">
                                <h5>نام </h5>
                                {!! Form::text('first_name', null, ['required' => 'required', 'tabindex' => '1']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-1">
                                <h5>جنسیت</h5>
                                {!! Form::select('gender', ['1' => 'مرد', '0' => 'زن'], null, ['style'=>'height:40px','class'=>'pull-right','tabindex' => '4']) !!}
                            </div>
                            <div class="col-lg-5 col-sm-6">
                                <h5>رایانامه </h5>
                                {!! Form::text('email', null, ['required' => 'required', 'tabindex'=>'3']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-1">
                                <h5>شغل</h5>
                                {!! Form::text('occupation', null, ['tabindex'=>'6']) !!}
                            </div>
                            <div class="col-lg-5 col-sm-6">
                                <h5>موبایل </h5>
                                {!! Form::text('cellphone', null, ['tabindex'=>'5']) !!}
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 push-0 push-sm-6">
                                <h5>عکس پروفایل </h5>
                                <div class="inputs">
                                    <div class="fileUpload uploadImageBtn pull-right">
                                        <p style="margin-top: -6px">آپلود عکس +</p>
                                        <input name="img" id="uploaduserImg" type="file" class="upload" />
                                    </div>
                                    <input id="userUploadPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="pull-right" id="save" tabindex="7">ثبت</button>
                    {!! Form::close() !!}
                </div>
            </div>
@endsection

@section('info')
    style="background-color: #00b3ee"
@endsection

@section('down-includes')
                <script>
                    document.getElementById("uploaduserImg").onchange = function () {
                        document.getElementById("userUploadPlace").value = this.value;
                    };
                </script>

@endsection