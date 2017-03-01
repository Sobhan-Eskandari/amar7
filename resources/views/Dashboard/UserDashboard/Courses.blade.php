@extends('layouts.DarskhanUser')

@section('title')
    موسسه دانش آماری | محتواهای آماری {{ \Illuminate\Support\Facades\Auth::user()->full_name }}
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/boughtLessons.css">
    <link rel="stylesheet" href="../css/user_dashboard_sidebar.css">
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">
@endsection

@section('content')
    <div class="container-fluid">
        <div class="row">
            <div class="col-xl-10 col-lg-10 col-md-9 col-sm-9 col-9">
                <div class="container">

                    <div class="row hidden-md-down" id="headline">
                        <div class="col-xl-6 col-lg-6 col-md-12 offset-xl-1 offset-lg-1 pull-right">
                            <h5>دانلود محتوای آماری</h5>
                        </div>
                        <div class="col-xl-2 col-lg-2 col-md-12 offset-lg-3">
                            <h5> محتوای آماری</h5>
                        </div>
                    </div>
                    @foreach($lessons as $lesson)
                        @if($loop->first)
                            <div class="row factor" id="firstFactor">
                        @else
                            <div class="row factor">
                        @endif
                            <div class="col-xl-8 col-lg-8 col-md-12 push-lg-4  factor_right">
                                <img class="course_img hidden-xs-down" src="lessonPhoto/{{ count($lesson->photo) != 0 ? $lesson->photo[0]['path'] : "coun.png" }}">
                                <div class="factor_info">
                                    <h4>{{ $lesson->lesson_name }}</h4>
                                    <ul>
                                        <li>{{ $lesson->categories[0]['name'] }}<span class="line-brake">|</span></li>
                                        <li>{{ count($lesson->sessions) }}&nbsp; زیر محتوای آماری<span class="line-brake">|</span></li>
                                        <li>{{ isset($lesson->cost) ? "$lesson->cost تومان" : 'رایگان' }}</li>
                                    </ul>
                                </div>

                            </div>
                            <div class="col-xl-3 col-lg-3 col-md-12 pull-lg-8 offset-lg-1">
                                <a href="{{ route('user-sessions', $lesson->id) }}"><button class="downloadCourse">دانلود زیر محتواهای آماری&nbsp;&nbsp;<i class="fa fa-download" aria-hidden="true"></i> </button></a>
                            </div>
                        </div>
                    @endforeach
                </div>

            </div>
@endsection

@section('courses')
    style="background-color: #00b3ee"
@endsection

@section('down-includes')

@endsection