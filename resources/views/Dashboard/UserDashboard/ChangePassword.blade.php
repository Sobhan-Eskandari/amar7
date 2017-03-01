@extends('layouts.DarskhanUser')

@section('title')
    موسسه دانش آماری | تغییر رمز عبور
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../../css/footer.css">
    <link rel="stylesheet" href="../../css/navbar.css">
    <link rel="stylesheet" href="../../css/user_dashboard_sidebar.css">
    <script src="../../bower_components/jquery/dist/jquery.js"></script>
    <script src="../../bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="../../css/loginSignupStyle.css">
    <link rel="stylesheet" type="text/css" href="../../css/user_info.css">
@endsection

@section('content')

    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9 col-9">

                @if(count($errors) > 0)
                    <div class="alert alert-danger pull-right" style="width:350px;margin-left: 60%; margin-right: 13%; margin-top: 3%">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if(Session::has('wrong_password'))
                    <div class="alert alert-danger pull-right" style="width:350px;margin-left: 70%; margin-right: 13%; margin-top: 3%; padding-bottom: 0;">
                        <p>{{ session('wrong_password') }}</p>
                    </div>
                @endif

                @if(Session::has('changed_password'))
                    <div class="alert alert-success pull-right" style="width:350px;margin-left: 70%; margin-right: 13%; margin-top: 3%; padding-bottom: 0;">
                        <p>{{ session('changed_password') }}</p>
                    </div>
                @endif

                <div class="container" id="user_info_main">
                    {!! Form::model($user, ['method' => 'PUT', 'action' => ['UserDashboardController@UpdatePassword', $user->id]]) !!}
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-6 offset-md-6 offset-sm-6">
                                <h5>رمز عبور فعلی</h5>
                                {!! Form::password('old_password', ['class'=>'form-control', 'tabindex'=>'1']) !!}
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-6 offset-md-6 offset-sm-6 pull-right" >
                                <h5>رمز عبور جدید</h5>
                                {!! Form::password('password', ['class'=>'form-control', 'tabindex'=>'2']) !!}
                            </div>

                        </div>
                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-6 offset-md-6 offset-sm-6 pull-right">
                                <h5>تکرار رمز عبور جدید</h5>
                                {!! Form::password('password_confirmation', ['class'=>'form-control', 'tabindex'=>'3']) !!}
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-lg-5 col-sm-6 offset-lg-7 offset-md-7 offset-sm-8 offset-6 pull-right">
                                <button type="submit" class="pull-right" id="save">تغییر رمز عبور</button>
                            </div>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
@endsection

@section('password')
    style="background-color: #00b3ee"
@endsection

@section('down-includes')

@endsection