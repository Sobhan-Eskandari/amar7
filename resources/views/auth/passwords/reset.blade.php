@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | بازیابی رمز عبور
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/contactusStyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/loginSignupStyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/forgetpass.css">
    <script src="../../bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" href="../../css/allcoursesStyle.css">
    <link rel="stylesheet" href="../../css/style.css">
    <link rel="stylesheet" href="../../css/homeStyle.css">
    <link rel="stylesheet" href="../../css/user_dashboard_sidebar.css">
    <link rel="stylesheet" type="text/css" href="../../css/loginSignupStyle.css">
    <script src="../../js/reponsive.js"></script>

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
                            {{--<div class="col-10 offset-1 error">--}}
                            {{--<p> تغییر رمز را درست کنید تغییر رمز را درست کنید تغییر رمز را درست کنید</p>--}}
                            {{--</div>--}}
                        </div>

                        <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
                            {{ csrf_field() }}

                            <input type="hidden" name="token" value="{{ $token }}">

                            <div class="form-group row rowOfInputs">
                                <div class="col-sm-9">
                                    <input name="email" value="{{ $email or old('email') }}" required autofocus type="email" class="form-control" id="inputEmail3" placeholder="ایمیل خود را وارد کنید">
                                </div>
                                <label for="inputEmail3" class="col-sm-3 col-form-label">ایمیل</label>
                            </div>
                            <div class="form-group row rowOfInputs">
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="inputPass" placeholder="رمز عبور جدید را وارد کنید" name="password" required>
                                </div>
                                <label for="inputPass" class="col-sm-3 col-form-label">رمز عبور</label>
                            </div>
                            <div class="form-group row rowOfInputs">
                                <div class="col-sm-9">
                                    <input type="password" class="form-control" id="confirmInputPass" placeholder="رمز عبور جدید را تکرار کنید"  name="password_confirmation" required>
                                </div>
                                <label for="confirmInputPass" class="col-sm-3 col-form-label">تایید رمز عبور</label>
                            </div>
                            <button type="submit" class="btn btn-primary" id="changePassBtn">تغییر رمز</button>
                        </form>
                    </div>
                </div>
            </div>

        </div>

    </div>
    <!-----------------------End of top header of site------------------------->
    <br><br><br>
@endsection

@section('footer-category')
    @foreach($course_categories as $category)
    <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        @if($loop->first || $loop->iteration === 9)
            <div class="col-3">
                @if($loop->first)
                    <p> پیوندها</p>
                @endif
                <ul style="margin-bottom: 100px;">
                    @endif
                    <li><a href="{{ $share->url }}" target="_blank">{{ $share->name }}</a></li>
                    @if($loop->iteration === 8 || $loop->last)
                </ul>
            </div>
        @endif
    @endforeach
@endsection

@section('down-includes')
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection