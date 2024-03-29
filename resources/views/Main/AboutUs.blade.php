@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | درباره ما
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/aboutUsStyle.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">

    <style>
        .jumbotron{
            padding-bottom: 0px;
            background: transparent;
        }
    </style>
@endsection

@section('content')
    <div class="container" style="width: 100%; height: 100%; margin-right:0px; margin-left:0px; background: url('siteInfoPhotos/{{ $info->aboutUs_img }}')">
        <div class="row">
            <!--motto part of header-->
            <div class="col col-12">
                <h1 id="work_motto" class="display-6">ما به همه فرصت آموختن علم را در همه جا میدهیم</h1>
            </div>
        </div>
    </div>
    </div>

    <div class="container">
        <div class="row" id="eslimi">
            <div class="col-12">
                <ul>
                    <li id="right"><img src="images/eslimi.png"></li>
                    <li id="left"><img  src="images/eslimi.png"></li>
                </ul>
            </div>
        </div>
        <div class="row" id="abouUsSection">
            <div hidden class="col-12" id="tohideText">
                {{ isset($info['aboutUs_txt']) ? $info['aboutUs_txt'] : "پیش فرض" }}
            </div>

            <div class="col-12">
                <img src="images/amar7-logo2.png">
                <h3>درباره ما</h3>
                <p id="toShowText"></p>
            </div>

            <script>
                $( document ).ready(function() {
                    $('#toShowText').html($('#tohideText').text());
                    $('#tohideText').css("display","none")
                });
            </script>

            <button type="button" class="btn btn-primary"><a style="color: whitesmoke" href="{{ route('contact-us') }}">نظرات و شکایات</a></button>
        </div>
    </div>
    <!-----------------------End of top header of site------------------------->
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        @if($loop->first || $loop->iteration === 10)
            <div class="col-3">
                @if($loop->first)
                    <p> پیوندها</p>
                @endif
                <ul style="margin-bottom: 100px;">
                    @endif
                    <li><a href="{{ $share->url }}" target="_blank">{{ $share->name }}</a></li>
                    @if($loop->iteration === 9 || $loop->last)
                </ul>
            </div>
        @endif
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