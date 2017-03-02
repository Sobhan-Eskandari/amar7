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
                    <div class="col-3">
                        {{--name of instructor--}}
                        <p><i class="fa fa-user" aria-hidden="true"></i> {{ $lesson->instructor }} </p>
                    </div>
                    <div class="col-3">
                        {{--number of all sessions--}}
                        <p><i class="fa fa-book" aria-hidden="true"></i> {{ count($lesson->sessions) }} زیر محتوای آماری</p>
                    </div>
                    <div class="col-3">
                        {{--name of one category of the lesson--}}
                        <p><i class="fa fa-filter" aria-hidden="true"></i> {{ $lesson->categories[0]['name'] }} </p>
                    </div>
                    <div class="col-3">
                        {{--to be determined--}}
                        <p><i class="fa fa-eye" aria-hidden="true"></i> ۳۰ دقیقه </p>
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
                        <h1>{{ $session->session_name }}</h1>
                        <p id="tohide">{{ $session->session_desc }}</p>
                        <p id="toShow">{{ $session->session_desc }}</p>
                        <script>
                            $( document ).ready(function() {
                                $('#toShow').html($('#tohide').text());
                                $('#tohide').css("display","none")
                            });
                        </script>
                        <div class="row" id="buySection">
                            <div class="col-6">
                                @if($lesson->cost != NULL)
                                @if(\Illuminate\Support\Facades\Auth::user())
                                    @if(\Illuminate\Support\Facades\Auth::user()->UserRole())
                                         @if($hasUser == 1)
                                             {!! Form::open(['method'=>'POST','action'=>['UserDashboardController@addToCart',$lesson->id]]) !!}
                                             {!! Form::button('افزودن به سبد خرید',['type'=>'submit']) !!}
                                             {!! Form::close() !!}
                                         @else
                                               @if(isset($lesson->pivot->bought) && $lesson->pivot->bought==0)
                                                  <button>به سبد خرید اضافه شده</button>
                                                @else
                                                  <a href="../zipFiles/.{{$session->session_file}}" download> دانلود</a>
                                                @endif
                                        @endif
                                    @endif
                                @else
                                    <button>ثبت نام</button>
                                @endif
                                @else
                                    <a href="../zipFiles/.{{$session->session_file}}" download> دانلود</a>
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
                        <a class="nav-link " data-toggle="tab" href="#courseLessons" role="tab"> زیر محتواهای آماری </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#teacherInfo" role="tab">مشخصات مدرس</a>
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
                                    <img src="../../UsersPhotos/{{ count($lesson->user->photos) != 0 ? $lesson->user->photos[0]['path'] : 'icone.png' }}">
                                    <h3>{{ $lesson->instructor }}</h3>
                                    <p id="tohideText">{{ $lesson->instructor_desc }}</p>
                                    <p id="toShowText">{{ $lesson->instructor_desc }}</p>
                                    <script>
                                        $( document ).ready(function() {
                                            $('#toShowText').html($('#tohideText').text());
                                            $('#tohideText').css("display","none")
                                        });
                                    </script>
                                </div>
                            </div>
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
                <h2 class="newCoursesTtle">محتواهای آماری مرتبط</h2>
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
                                    {{--<p><img class="instructor_img" src="../UsersPhotos/{{ count($rand->user->photos) != 0 ? $rand->user->photos[0]['path'] : 'icone.png' }}"> {{ $rand->user['full_name'] }}</p>--}}
                                </div>
                            </div>
                            <!--Card body elements like title and text and cost and kind-->
                            <div class="card-block">
                                <h5 class="card-title">{{ $rand->lesson_name }}</h5>
                                <p class="card-text">{{ str_limit(strip_tags($rand->lesson_desc), 70) }}</p>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p>{{ isset($rand->cost) ? "$rand->cost تومان" : 'رایگان' }}</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($rand->categories[0]['name'], 7) }}</p>
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
@endsection

@section('footer-category')
    @foreach($course_categories as $category)
        <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection