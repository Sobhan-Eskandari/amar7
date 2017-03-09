@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | نتایج جست و جو
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/allcoursesStyle.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/homeStyle.css">
    <script src="../bower_components/jquery/dist/jquery.js"></script>

    <link rel="stylesheet" href="../css/slider.css">
    <link rel="stylesheet" href="../css/user_dashboard_sidebar.css">
    <link rel="stylesheet" type="text/css" href="../css/slick.css"/>
    <link rel="stylesheet" type="text/css" href="../css/slick-theme.css"/>
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">

    <link href='http://www.fontonline.ir/css/BYekan.css' rel='stylesheet' type='text/css'>
@endsection

@section('content')
</div>
    <!-----------------------End of top header of site------------------------->

    <div class="myCountainer">
        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">نتایج جست و جو</h2>
            </div>
        </div>
        @if($searches)
            @foreach($searches as $search)
                @if($loop->iteration === 1 || $loop->iteration === 5 || $loop->iteration === 9)
                    <div class="row" style="direction: rtl">
                @endif
                @if($search->lesson_name)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 cardLink">
                        <a href="{{ route('lessons.show', $search->id) }}">
                            <div class="courseCard card">
                                <!--Over card image elements instructor image and jalase counts-->
                                <img class="card-img-top" src="../lessonPhoto/{{ count($search->photo) != 0 ? $search->photo[0]['path'] : "coun.png" }}" alt="Card image cap">
                                <div class="row topCard">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-6">
                                        <p class="jalaseCounts"><i class="fa fa-eye fa-1x"></i> {{ $search->seen }}&nbsp;بازدید </p>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-6">
                                        <p><img class="instructor_img" src="../UsersPhotos/{{ count($search->user->photos) != 0 ? $search->user->photos[0]['path'] : 'icone.png' }}"> {{ $search->user['full_name'] }}</p>
                                    </div>
                                </div>
                                <!--Card body elements like title and text and cost and kind-->
                                <div class="card-block">
                                    <h5 class="card-title">{{ $search->lesson_name }}</h5>
                                    <p class="card-text">{{ str_limit(strip_tags($search->lesson_desc), 70) }}</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p>{{ isset($search->cost) ? "$search->cost تومان" : 'رایگان' }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($search->categories[0]['name'], 7) }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p>{{ $search->created_at->format('Y/m/d') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if($search->title)
                    <div class="col-lg-3 col-md-4 col-sm-6 col-xs-12 cardLink">
                        <a href="{{ route('wiki.show', $search->id) }}">
                            <div class="courseCard card">
                                <!--Over card image elements instructor image and jalase counts-->
                                <img class="card-img-top" src="../WikiPhotos/{{ count($search->photos) != 0 ? $search->photos[0]['path'] : 'default.png' }}" alt="Card image cap">
                                <div class="row topCard">
                                    <div class="col-lg-5 col-md-5 col-sm-5 col-6">
                                        <p class="jalaseCounts"><i class="fa fa-eye fa-1x"></i> {{ $search->seen }}&nbsp;بازدید </p>
                                    </div>
                                    <div class="col-lg-7 col-md-7 col-sm-7 col-6">
                                        <p><img class="instructor_img" src="../UsersPhotos/{{ count($search->master_photo) != 0 ? $search->master_photo : 'icone.png' }}"> {{ $search->master_name }}</p>
                                        {{--<p><img class="instructor_img" src="../UsersPhotos/{{ count($search->user->photos) != 0 ? $search->user->photos[0]['path'] : 'icone.png' }}"> {{ $search->user['full_name'] }}</p>--}}
                                    </div>
                                </div>
                                <!--Card body elements like title and text and cost and kind-->
                                <div class="card-block">
                                    <h5 class="card-title">{{ $search->title }}</h5>
                                    <p class="card-text">{{ str_limit(strip_tags($search->body), 70) }}</p>
                                    <div class="row">
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p>ادامه مطلب...</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p><i class="fa fa-filter fa-1x"></i>{{ str_limit($search->wiki_categories[0]['name'], 7) }}</p>
                                        </div>
                                        <div class="col-lg-4 col-md-4 col-sm-4 col-sm-4 col-4 card-item">
                                            <p>{{ $search->created_at->format('Y/m/d') }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </a>
                    </div>
                @endif
                @if($loop->iteration === 4 || $loop->iteration === 8 || $loop->last)
                    </div>
                @endif
            @endforeach
        @endif
    </div>
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

    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>
@endsection