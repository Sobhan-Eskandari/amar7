@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | {{ str_limit($wiki->title, 50) }}
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="../css/footer.css">
    <link rel="stylesheet" href="../css/navbar.css">
    <link rel="stylesheet" href="../css/style.css">
    <link rel="stylesheet" href="../css/articleStyle.css">
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="../css/loginSignupStyle.css">
    <script src="../bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

@endsection

@section('content')
</div>
    <!-----------------------End of top header of site------------------------->
    <div class="container">
        <div class="col-12" id="maghale">
            <div style="background-color: #EEEEEE;border-radius: 10px;margin-bottom: 35px" class="row" id="top_courseInfo">
                <div class="col-12" >
                    {{--name of one category of the lesson--}}
                    <p style="text-align: right; padding-top: 15px"><i class="fa fa-filter"  aria-hidden="true"></i>
                        @foreach($wiki->wiki_categories as $filter)
                            @if($loop->last)
                                {{ $filter['name'] }}
                            @else
                                {{ $filter['name'] . ' - ' }}
                            @endif
                        @endforeach
                    </p>
                </div>
            </div>
            <img src="../WikiPhotos/{{ count($wiki->photos) != 0 ? $wiki->photos[0]['path'] : 'default.png' }}">
            <h2>{{ $wiki->title }}</h2>

            <p id="tohideText">{{ $wiki->body }}</p>
            <p id="toShowText">{{ $wiki->body }}</p>
        </div>

        <script>
            $( document ).ready(function() {
                $('#toShowText').html($('#tohideText').text());
                $('#tohideText').css("display","none")
            });
        </script>
    </div>

    <div class="container">
        <div class="row" id="writer">
            {{--<div class="col-9">--}}

            {{--</div>--}}
            <div class="col-6" style="text-align: left">
                @if($wiki->file)
                    <a href="../WikiPDFs/{{ $wiki->file }}"><button class="downloadCourse" style="box-shadow: 0 1px 3px rgba(0, 0, 0, 0.12), 0 1px 2px rgba(0, 0, 0, 0.24);border-radius: 10px;border: transparent;background-color: #20A747;padding: 10px 15px;color: white;width: 30%;"> دانلود مقاله<i style="margin-left: 5px" class="fa fa-download" aria-hidden="true"></i> </button></a>
                @endif
            </div>
            <div class="col-6" style="text-align: right">
                <p>&nbsp;<i class="fa fa-user fa-2x" aria-hidden="true"></i>&nbsp;     نویسنده : &nbsp;{{ $wiki->user['full_name'] }}</p>
            </div>
        </div>
    </div>

    <hr>

    <div class="myCountainer">
        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">شاید علاقه مند باشید</h2>
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

    </div>

    <hr>
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        <li><a href="{{ $share->url }}">{{ $share->name }}</a></li>
    @endforeach
@endsection

@section('footer-category')
    @foreach($wiki_categories as $category)
        <li><a href="{{ route('WikiCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=fa"
            async defer>
    </script>
@endsection