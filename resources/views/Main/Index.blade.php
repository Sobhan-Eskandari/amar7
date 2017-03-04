@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | خانه
@endsection

@section('header-recaptcha')
    grecaptcha.render('grecaptcha-header-signup', {
    'sitekey' : '6Ld0ORcUAAAAAPzsIvkNhrT_QcrJP96w4-CblMyK',
    'theme' : 'light'
    });
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/allcoursesStyle.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/homeStyle.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>

    <link rel="stylesheet" href="css/slider.css">
    <link rel="stylesheet" type="text/css" href="css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="css/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">

    <link href='http://www.fontonline.ir/css/BYekan.css' rel='stylesheet' type='text/css'>
@endsection

@section('content')
   <div hidden> {{ Counter::showAndCount('home') }} </div>
    <div class="container">
        <div class="row">
            <div class="col col-lg-5 col-12">
                <!--sign up part of header-->
                @if(!Auth::Check())
                <div class="card" id="signupCard" style="
                    border-left-width: 0px;
                    border-right-width: 0px;
                    border-top-width: 0px;
                ">
                    <h5 class="card-title">همین امروز شروع کنین</h5>
                    <div class="card-block">
                        {!! Form::open(['method' => 'POST', 'action' => 'Auth\RegisterController@register']) !!}
                            <div class="row">
                                <div class="col-lg-6 col-ms-6 col-sm-6 col-6 signup_fields">
                                    {!! Form::text('last_name', null, ['placeholder' => 'نام خانوادگی', 'required' => 'required', 'tabindex' => '2']) !!}<br>
                                    <br>
                                    <input type="password" placeholder="رمز عبور" tabindex="4" name="password" required>
                                </div>
                                <div class="col-lg-6 col-ms-6 col-sm-6 col-6 signup_fields">
                                    {!! Form::text('first_name', null, ['placeholder' => 'نام', 'required' => 'required', 'tabindex' => '1']) !!}<br>
                                    <br>
                                    {!! Form::text('email', null, ['placeholder'=>'ایمیل', 'tabindex'=>'3']) !!}<br>
                                </div>
                            </div>
                            <div class="row">
                                <div style="margin-top: 15px;margin-left: 12%" class="col-10 offset-1" id="grecaptcha-header-signup"></div>
                            </div>
                            <div class="row">
                                <div class="col-12">
                                    <button type="submit" id="signupBtn" tabindex="5">ثبت نام</button>
                                </div>
                            </div>
                        {!! Form::close() !!}
                    </div>
                </div>
                @endif
            </div>
            <!--motto part of header-->
            <div class="col col-lg-6 col-12">
                {{--<h2 class="display-6">بهترین خودروی 25 تا 35 میلیون تومانی بازار را شما انتخاب کنید</h2>--}}
                <p class="work_motto lead"  id="toShowText">{{ isset($info['header_txt']) ? $info['header_txt'] : 'پیش فرض' }}</p>
                <p class="lead" id="tohideText">{{ isset($info['header_txt']) ? $info['header_txt'] : 'پیش فرض' }}</p>
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
    <!-----------------------End of top header of site------------------------->

    <div class="myCountainer">
        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">جدیدترین محتواهای آماری</h2>
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

        <div class="col-3 offset-5">
            <a href="{{ route('allCourses') }}"><button id="showAllLessons">نمایش تمام محتواها</button></a>
        </div>

    </div>

    <div class="container-fluid">
        <div class="row" id="sepratorPart">
            <div class="col-6">
                <img src="images/Headphone.png">
            </div>
            <div class="col-6">
                <h4>این دوره پیشنیاز برنامه‌نویسی اندروید برای کسانی است که تجربه برنامه‌نویسی خاصی ندارند؛ بخش اول از مجموعه دوره‌های «آموزش برنامه‌نویسی اندروید از پایه تا پیشرفته»</h4>
            </div>
        </div>
    </div>


    <div class="myCountainer">
        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">جدیدترین مقالات</h2>
            </div>
        </div>
        
        <div class="row" style="direction: rtl">
            @foreach($wikis as $rand)
                <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 cardLink">
                    <a href="{{ route('wiki.show', $rand->id) }}">
                        <div class="courseCard card">
                            <!--Over card image elements instructor image and jalase counts-->
                            <img class="card-img-top" src="../WikiPhotos/{{ count($rand->photos) != 0 ? $rand->photos[0]['path'] : 'default.png' }}" alt="Card image cap">
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
                                <h5 class="card-title">{{ $rand->title }}</h5>
                                <p class="card-text">{{ str_limit(strip_tags($rand->body), 70) }}</p>
                                <div class="row">
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p>ادامه مطلب...</p>
                                    </div>
                                    <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                        <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($rand->wiki_categories[0]['name'], 7) }}</p>
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

        <div class="col-3 offset-5">
            <a href="{{ route('allWiki') }}"><button id="showAllLessons">نمایش تمام مقالات</button></a>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 offset-lg-2 offset-md-2 offset-sm-1" style="z-index: 20">
                <button id="aboutUS"> <a style="color: whitesmoke" href="{{ route('aboutUs') }}">درباره ما</a> <i class="fa fa-id-card" aria-hidden="true"></i> </button>
            </div>
            <div class="col-lg-2 col-md-4 col-sm-4 col-6 offset-lg-4 offset-md-1 offset-sm-2" style="z-index: 20">
                <button id="contactUs">  <a style="color: whitesmoke" href="{{ route('contact-us') }}">تماس با ما</a> <i class="fa fa-phone" aria-hidden="true"></i></button>
            </div>
        </div>
        <div class="row" id="laptop_slideshow">
            <div class="col-12">
                <section class="regular slider">
                    <div>
                        <img class="hidden-xs-down" src="siteInfoPhotos/{{ isset($info['thSlider_img']) ? $info['thSlider_img'] : '' }}">
                        <p>{{ isset($info['thSlider_txt']) ? $info['thSlider_txt'] : 'پیش فرض' }}</p>
                    </div>
                    <div>
                        <img class="hidden-xs-down" src="siteInfoPhotos/{{ isset($info['ndSlider_img']) ? $info['ndSlider_img'] : '' }}">
                        <p>{{ isset($info['ndSlider_txt']) ? $info['ndSlider_txt'] : 'پیش فرض' }}</p>
                    </div>
                    <div>
                        <img class="hidden-xs-down" src="siteInfoPhotos/{{ isset($info['rdSlider_img']) ? $info['rdSlider_img'] : '' }}">
                        <p>{{ isset($info['rdSlider_txt']) ? $info['rdSlider_txt'] : 'پیش فرض' }}</p>
                    </div>
                </section>
            </div>
        </div>
    </div>
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
    <script src="https://code.jquery.com/jquery-2.2.0.min.js" type="text/javascript"></script>

    <script src="js/slick.min.js" type="text/javascript" charset="utf-8"></script>

    <script type="text/javascript">
        $(document).on('ready', function() {
            $(".regular").slick({
                slidesToShow: 1,
                slidesToScroll: 1,
                dots:true,
                autoplay: false,
                autoplaySpeed: 2000
            });
        });
    </script>

    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection