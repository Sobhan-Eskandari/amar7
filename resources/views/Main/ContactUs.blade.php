@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | نظرات و شکایات
@endsection

@section('header-recaptcha')
    grecaptcha.render('grecaptcha-contact', {
    'sitekey' : '6Ld0ORcUAAAAAPzsIvkNhrT_QcrJP96w4-CblMyK',
    'theme' : 'light'
    });
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/contactusStyle.css">
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <style>
        .jumbotron{
            padding-bottom: 0px;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="width: 100%; height: 100%; margin-right:0px; margin-left:0px; background: url('siteInfoPhotos/{{ $info->contactUs_img }}')">
        <div class="row">
            <!--motto part of header-->
            <div class="col col-12">
                <h1 id="work_motto" class="display-6">با ما در ارتباط باشید</h1>
            </div>
        </div>
    </div>
    </div>
    <!-----------------------End of top header of site------------------------->

    <!------------------------Contact Us Part------------------------------>
    <div class="container" id="contactUSPart">
        <div class="row">
            <div class="col-lg-3" id="leftContactUs">
                <p class="contactUSTitles">: پست الکترونیکی <i class="fa fa-envelope" aria-hidden="true"></i></p>
                <p>{{ isset($info->email) ? $info->email : 'info@amar7.ir' }}</p>
                <hr>
                <p class="contactUSTitles">: (شماره تماس (موبایل <i class="fa fa-phone" aria-hidden="true"></i></p>
                <p>{{ isset($info->number) ? $info->number : '09112921512' }}</p>
                <hr>
                <p class="contactUSTitles">: (شماره تماس (خط ثابت <i class="fa fa-phone" aria-hidden="true"></i></p>
                <p>{{ isset($info->landline) ? $info->landline : '01154288123' }}</p>
                <hr>
                <p class="contactUSTitles">:  شبکه های اجتماعی <i class="fa fa-wifi" aria-hidden="true"></i></p>
                <p><i class="fa fa-instagram" aria-hidden="true"></i>{{ isset($info->instagram) ? $info->instagram : 'https://www.instagram.com/' }}</p>
                <p><i class="fa fa-telegram" aria-hidden="true"></i>{{ isset($info->telegram) ? $info->telegram : 'https://telegram.org/' }}</p>
                <hr>
            </div>
            <div class="col-lg-8 offset-lg-1" id="rightAbountUS">

                <br>
                {!! Form::open(['method'=>'POST','action'=>'MessageController@store']) !!}
                    <div class="row">
                        @if(Session::has('send_message'))
                            <div class="alert alert-success" style="margin-left: 70%; margin-right: 64px">
                                <p>{{ session('send_message') }}</p>
                            </div>
                        @endif
                            @if(Session::has('robot_message'))
                                <div class="alert alert-danger" style="margin-left: 70%; margin-right: 64px">
                                    <p>{{ session('robot_message') }}</p>
                                </div>
                            @endif
                        @if(count($errors) > 0)
                            <div class="alert alert-danger" style="margin-left: 30%; margin-right: 64px">
                                <ul>
                                    @foreach($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif
                        <div class="col-6 form-group">
                            <label for="exampleInputPassword1">نام و نام خانوادگی</label>
                            {!! Form::text('name',null,['class'=>'form-control','id'=>'exampleInputPassword1','placeholder'=>'نام','tabindex'=>'1']) !!}
                        </div>
                        <div class="col-6 form-group">
                            <label for="exampleInputEmail1">ایمیل</label>
                            {!! Form::text('email',null,['class'=>'form-control','id'=>'exampleInputEmail1','aria-describedby'=>'emailHelp','placeholder'=>'پست الکترونیکی','tabindex'=>'2']) !!}
                            <small id="emailHelp" class="form-text text-muted">ما پست الکترونیگی شما را به اشتراک نمیگذاریم</small>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col col-12">
                            <div class="form-group">
                                <label for="exampleTextarea">پیام شما</label>
                                {!! Form::textarea('message',null,['class'=>'form-control','id'=>'exampleTextarea','rows'=>'3','tabindex'=>'3']) !!}
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-12" id="grecaptcha-contact"></div>
                    </div>
                <br>
                    <!-- Indicates a successful or positive action -->
                    {!! Form::button('ارسال پیام',['type'=>'submit','class'=>'btn btn-success']) !!}
                <hr>
                <p class="contactUSTitles" style="margin-top: 15px;"><i class="fa fa-map-marker" aria-hidden="true"></i> آدرس پستی</p>
                <p>{{ $info->address }}</p>

                {!! Form::close() !!}
            </div>
        </div>
    </div>
    <!------------------------End of Contact Us Part------------------------------>
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        <li><a href="{{ $share->url }}" target="_blank">{{ $share->name }}</a></li>
    @endforeach
@endsection

@section('footer-category')
    @foreach($course_categories as $category)
        <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection