@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | بازیابی رمز عبور
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/contactusStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">
    <link rel="stylesheet" type="text/css" href="../css/forgetpass.css">
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="../css/allcoursesStyle.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/homeStyle.css">
    <link rel="stylesheet" href="../css/user_dashboard_sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">
    <script src="../js/reponsive.js"></script>

@endsection

@section('content')
    <br><br>
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="row">
                    <div class="col-lg-6 offset-3 password_box">
                        <div class="row fa-pull-right">
                            <div class="col">
                                <p>تغییر رمز</p>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-lg-6 offset-3 second_password_box">
                        <div class="row">
                            {{--@if (session('status'))--}}
                                {{--<div class="col-10 offset-1 error">--}}
                                    {{--<p>{{ session('status') }}</p>--}}
                                {{--</div>--}}
                            {{--@endif--}}
                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
                            {{ csrf_field() }}

                            <div class="form-group row rowOfInputs">
                                <div class="col-sm-9">
                                    <input name="email" type="email" class="form-control" id="inputEmail3" placeholder=" ایمیل خود را وارد کنید" value="{{ old('email') }}">
                                </div>
                                <label for="inputEmail3" class="col-sm-3 col-form-label">:ایمیل</label>
                            </div>

                            <button type="submit" class="btn btn-primary" id="changePassBtn">ارسال لینک تغییر رمز</button>

                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <br><br><br>
    <!-----------------------End of top header of site------------------------->
@endsection

@section('footer-category')
    @foreach($course_categories as $category)
    <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('footer-shares')
    @foreach($shares as $share)
    <li><a href="{{ $share->url }}">{{ $share->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection