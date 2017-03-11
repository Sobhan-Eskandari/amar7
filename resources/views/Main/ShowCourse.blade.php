@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | {{ $lesson->lesson_name }}
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/aboutUsStyle.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/coursePageStyle.css">
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">
@endsection

@section('content')
</div>
    <!------------------------  CoursePage top Section ------------------------------>

    <div class="container">
        <div class="row">

            <div class="col-12" id="courseSection">

                <div class="row" id="top_courseInfo">
                    <div class="col-12" >
                        {{--name of one category of the lesson--}}
                        <p style="text-align: right"><i class="fa fa-filter"  aria-hidden="true"></i>
                            دسته بندی ها: 
                            @foreach($lesson->categories as $filter)
                                @if($loop->last)
                                    {{ $filter['name'] }}
                                @else
                                    {{ $filter['name'] . ' - ' }}
                                @endif
                            @endforeach
                        </p>
                    </div>
                </div>
                <div class="row" id="top_courseAttachments">
                    <div class="col-3">
                        <p> <i class="fa fa-film" aria-hidden="true"></i> فیلم آموزشی
                            @if(isset($lesson->video))
                                <i class="fa fa-check tick" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-check fa-remove" aria-hidden="true"></i>
                            @endif
                        </p>
                    </div>
                    <div class="col-3">
                        <p><i class="fa fa-microphone" aria-hidden="true"></i>  صدای آموزشی
                            @if(isset($lesson->mp3))
                                <i class="fa fa-check tick" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-check fa-remove" aria-hidden="true"></i>
                            @endif
                        </p>
                    </div>
                    <div class="col-3">
                        <p><i class="fa fa-file-text" aria-hidden="true"></i>  مقاله آموزشی
                            @if(isset($lesson->pdf))
                                <i class="fa fa-check tick" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-check fa-remove" aria-hidden="true"></i>
                            @endif
                        </p>
                    </div>
                    <div class="col-3">
                        <p><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> اسلاید آموزشی
                            @if(isset($lesson["power point"]))
                                <i class="fa fa-check tick" aria-hidden="true"></i>
                            @else
                                <i class="fa fa-check fa-remove" aria-hidden="true"></i>
                            @endif
                        </p>
                    </div>
                </div>

                <div class="row" id="course_overView">
                    <div class="col-lg-4 col-md-5 col-sm-12 col-12 push-xl-8 push-lg-8 push-md-7">
                        {{--the image if the course goes here--}}
                        <img src="../lessonPhoto/{{ count($lesson->photo) != 0 ? $lesson->photo[0]['path'] : "coun.png" }}">
                    </div>
                    <div class="col-lg-8 col-md-7 col-sm-12 col-12 pull-xl-4 pull-lg-4 pull-md-5">
                        <h1>{{ $lesson->lesson_name }}</h1>
                        <p id="toShowText"></p>
                        <p hidden id="tohideText">{{ $lesson->lesson_desc }}</p>
                        <script>
                            $( document ).ready(function() {
                                $('#toShowText').html($('#tohideText').text());
                                $('#tohideText').css("display","none")
                            });
                        </script>
                        <div class="row" id="buySection">
                            <div class="col-6">
                                @if($lesson->cost != NULL)
                                @if(\Illuminate\Support\Facades\Auth::check())
                                    @if(\Illuminate\Support\Facades\Auth::user()->UserRole())
                                        @if($hasUser == 1)
                                            {!! Form::open(['method'=>'POST','action'=>['UserDashboardController@addToCart',$lesson->id]]) !!}
                                            {!! Form::button('افزودن به سبد خرید',['type'=>'submit']) !!}
                                            {!! Form::close() !!}
                                        @elseif(isset($lesson->pivot->bought))
                                            @if($lesson->pivot->bought == 0)
                                                <button>به سبد خرید اضافه شده</button>
                                            @elseif($lesson->pivot->bought == 1)
                                                <button> خریداری شده</button>
                                            @endif
                                        @endif
                                    @endif
                                @else
                                    <button data-toggle="modal" data-target="#exampleModalLong">دانلود محتوا</button>
                                @endif
                                @else
                                    {{--<button data-toggle="modal" data-target="#exampleModalLong">رایگان</button>--}}
                                @endif
                            </div>
                            <div class="col-6">
                                <p> قیمت پرداختی :  <span id="cost">{{ isset($lesson->cost) ? "$lesson->cost تومان" : 'رایگان' }}</span> </p>
                            </div>
                        </div>
                    </div>
                </div>

            </div>

        </div>



        <div class="row">
            <div class="col-12" id="course_mainInfo_section">
                <!-- Nav tabs -->
                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#courseInfo" role="tab">توضیحات تکمیلی</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link " data-toggle="tab" href="#courseLessons" role="tab"> زیر محتواها</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#teacherInfo" role="tab">مشخصات نویسنده</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#tags" role="tab">برچسب ها</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content" id="tabOfContents">
                    <div class="tab-pane fade show active" id="courseInfo" role="tabpanel">
                        <h3>{{ $lesson->lesson_name }}</h3>
                        {{--a litle description of all sessions of the lesson in a new line with the name of session in h2 tag--}}
                        @foreach($lesson->sessions as $session)
                            <h5>{{ $session->session_name }}</h5>
                            {{ strip_tags($session->session_desc) }}
                        @endforeach
                    </div>

                    <div class="tab-pane fade " id="courseLessons" role="tabpanel">

                        <div class="row">
                            <div class="col-12 pull-0">
                                <table class="table table-striped">
                                    <thead class="thead-inverse">
                                    <tr>
                                        <th>ردیف</th>
                                        <th rowspan="1">نام محتوای آماری</th>
                                        <th><i class="fa fa-film" aria-hidden="true"></i> فیلم آموزشی</th>
                                        <th><i class="fa fa-microphone" aria-hidden="true"></i> صدای آموزشی</th>
                                        <th><i class="fa fa-file-text" aria-hidden="true"></i> مقاله آموزشی</th>
                                        <th><i class="fa fa-file-powerpoint-o" aria-hidden="true"></i> اسلاید آموزشی</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    @foreach($lesson->sessions as $session)
                                        <tr>
                                            <th scope="row">1</th>
                                            <td colspan="1"><a href="{{route('sessions.show',$session->id)}}" >{{ $session->session_name }}</a></td>
                                            @if(isset($lesson->video))
                                                <td><i class="fa fa-check tick" aria-hidden="true"></i></td>
                                            @else
                                                <td><i class="fa fa-check fa-remove" aria-hidden="true"></i></td>
                                            @endif
                                            @if(isset($lesson->mp3))
                                                <td><i class="fa fa-check tick" aria-hidden="true"></i></td>
                                            @else
                                                <td><i class="fa fa-check fa-remove" aria-hidden="true"></i></td>
                                            @endif
                                            @if(isset($lesson->pdf))
                                                <td><i class="fa fa-check tick" aria-hidden="true"></i></td>
                                            @else
                                                <td><i class="fa fa-check fa-remove" aria-hidden="true"></i></td>
                                            @endif
                                            @if(isset($lesson['power point']))
                                                <td><i class="fa fa-check tick" aria-hidden="true"></i></td>
                                            @else
                                                <td><i class="fa fa-check fa-remove" aria-hidden="true"></i></td>
                                            @endif
                                        </tr>
                                    @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>

                    </div>


                    <div class="tab-pane fade" id="teacherInfo" role="tabpanel">

                        <div class="container">
                            <div class="row" id="eslimi">
                                <div class="col-12">
                                    <ul>
                                        <li id="right"><img src="../images/eslimi.png"></li>
                                        <li id="left"><img  src="../images/eslimi.png"></li>
                                    </ul>
                                </div>
                            </div>
                            <div class="row" id="abouUsSection">
                                <div class="col-12">
                                    <img src="../UsersPhotos/{{ count($lesson->user->photos) != 0 ? $lesson->user->photos[0]['path'] : 'icone.png' }}">
                                    <h3>{{ $lesson->instructor }}</h3>
                                    <p hidden id="tohide">{{ $lesson->instructor_desc }}</p>
                                    <p id="toShow"></p>
                                    <script>
                                        $( document ).ready(function() {
                                            $('#toShow').html($('#tohide').text());
                                            $('#tohide').css("display","none")
                                        });
                                    </script>
                                </div>
                            </div>
                        </div>

                    </div>

                    <div class="tab-pane fade" id="tags" role="tabpanel">
                        <div class="container" style="margin-right: 50px; padding-top: 15px">
                            <h4>برچسب ها:</h4>
                            @foreach($lesson->tags as $tag)
                                @if($loop->last)
                                    {{ $tag['name'] }}
                                @else
                                    {{ $tag['name'] . ' - ' }}
                                @endif
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>

    <hr>
    <div class="myCountainer">
        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">محتوای مرتبط</h2>
            </div>
        </div>

        <div class="row" style="direction: rtl">
            @foreach($lessons as $rand)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 cardLink">
                    <a href="{{ route('lessons.show', $rand->id) }}">
                        <div class="courseCard card">
                            <!--Over card image elements instructor image and jalase counts-->
                            <img class="card-img-top" src="../lessonPhoto/{{ count($rand->photo) != 0 ? $rand->photo[0]['path'] : "coun.png" }}" alt="Card image cap">
                            <div class="row topCard">
                                <div class="col-lg-5 col-md-5 col-sm-5 col-6">
                                    <p class="jalaseCounts"><i class="fa fa-eye fa-1x"></i> {{ $rand->seen }}&nbsp;بازدید </p>
                                </div>
                                <div class="col-lg-7 col-md-7 col-sm-7 col-6">
                                    <p><img class="instructor_img" src="../UsersPhotos/{{ count($rand->user->photos) != 0 ? $rand->user->photos[0]['path'] : 'icone.png' }}"> {{ $rand->user['full_name'] }}</p>
                                </div>
                            </div>
                            <!--Card body elements like title and text and cost and kind-->
                            <div class="card-block">
                                <h5 class="card-title">{{ $rand->lesson_name }}</h5>
                                <p class="card-text">{{ str_limit(strip_tags($rand->lesson_desc), 80) }}</p>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p>{{ isset($rand->cost) ? "$rand->cost تومان" : 'رایگان' }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($rand->categories[0]['name'], 8) }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p>{{ $rand->created_at->format('Y/m/d') }}</p>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </a>
                </div>
            @endforeach
        </div>

    </div>
    <hr>

    <!------------------------------ Signin Signup Modal ------------------------------>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="signup_login_panel">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#signup" role="tab">ثبت نام</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#loginpanel" role="tab">ورود</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane active" id="loginpanel" role="tabpanel">
                        {!! Form::open(['method' => 'POST', 'action' => 'Auth\LoginController@login']) !!}
                        <div class="row">
                            <div class="col-12 offset-1">
                                <input id="loginmail" type="email" placeholder="&#xF0e0;  ایمیل" style="font-family:BYekan,FontAwesome" name="email" value="{{ old('email') }}" required>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-12 offset-1">
                                <input type="password" placeholder="&#xF023;  گذرواژه" style="font-family:BYekan,FontAwesome" name="password" required>
                            </div>
                        </div>

                        <div class="row">

                            <div class="col-8 offset-2 rememberMe">
                                <a class="btn btn-link" href="{{ url('/password/reset') }}">رمز عبور خود را فراموش کرده اید؟</a>
                                {{--<p> مرا به خاطر نگه دار <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}></p>--}}
                            </div>

                            <div style="margin-top: 10px;margin-bottom: 10px" class="col-10 offset-2" id="grecaptcha-popup-login"></div>
                        </div>

                        <div class="row" id="loginBtn">
                            <div class="col-12">
                                <button type="submit">ورود</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>
                    {{--singup section--}}

                    <div class="tab-pane" id="signup" role="tabpanel">
                        {!! Form::open(['method' => 'POST', 'action' => 'Auth\RegisterController@register']) !!}
                        <div class="row">
                            <div class="col-1 offset-xl-2 offset-lg-1 offset-md-1 offset-sm-1 offset-1" style="margin-left: 13%;">
                                <input type="text" placeholder="&#xF023;  نام خانوادگی" style="font-family:BYekan,FontAwesome" name="last_name">
                            </div>
                            <div class="col-1 offset-4">
                                <input type="text" placeholder="&#xF2be;  نام" style="font-family:BYekan,FontAwesome" name="first_name">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-11 offset-1" style="margin-left: 12%;">
                                <input id="mail" type="text" placeholder="&#xF0e0;  ایمیل" style="font-family:BYekan,FontAwesome" name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-11 offset-1" style="margin-left: 12%;">
                                <input id="mail" type="password" placeholder="&#xF023;  گذرواژه" style="font-family:BYekan,FontAwesome" name="password">
                            </div>
                        </div>

                        <div class="row">
                            <div style="margin-right:40px !important;margin-top: 10px;margin-bottom: 10px" class="col-10 offset-2" id="grecaptcha-popup-signup"></div>
                        </div>

                        <div class="row" id="signupBtn">
                            <div class="col-12">
                                <button data-toggle="modal" data-target="#exampleModalLong">ثبت نام</button>
                            </div>
                        </div>
                        {!! Form::close() !!}
                    </div>

                    {{--singup section--}}

                </div>

            </div>
        </div>
    </div>
    <!------------------------------ End of Signin Signup Modal ------------------------------>

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