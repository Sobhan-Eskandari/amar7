@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | تمام محتواهای آماری
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/allcoursesStyle.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/style.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/homeStyle.css">
    <link rel="stylesheet" href="css/user_dashboard_sidebar.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">
    <script src="js/reponsive.js"></script>

    <style>
        .donate-now label, .donate-now input {
            display:block;
            position:absolute;
            top:0;
            left:0;
            right:0;
            bottom:0;
        }

        .donate-now input[type="radio"] {
            opacity:0.011;
            z-index:100;
        }
        .donate-now input:checked{
            color: white;
        }

        .donate-now input[type="radio"]:checked + label {
            background:#204056;
            color: whitesmoke;
        }

        .donate-now label {
            padding: 8px 14px;
            border:0px solid #CCC;
            cursor:pointer;
            z-index:90;
            border-radius: 25px;
            margin:0 !important;
        }

        .donate-now label:hover {
            background:#DDD;
        }


        .donate-now li {
            float:left;
            margin:0 0px 0 0;
            width:60px;
            height:40px;
            background-color: white;

            position:relative;
        }
        .donate-now li:nth-child(1){
            background-color: white;
            border-top-left-radius: 25px;
            border-bottom-left-radius: 25px;
        }
        .donate-now li:nth-child(3){
            background-color: white;
            border-top-right-radius: 25px;
            border-bottom-right-radius: 25px;
        }
    </style>
@endsection

@section('content')

    </div>
    <!-----------------------End of top header of site------------------------->

    <!------------------------ Filter over cards ------------------------------>
    <div class="myCountainer">
        <div class="row" id="topFilters">
            <div class="col-lg-7 offset-lg-0">
                <section id="second" class="section">
                    <div class="container">
                        <input type="checkbox" name="group2" id="mp3">
                        <label for="mp3"><span class="checkbox">صدا</span></label>
                    </div>
                    <div class="container">
                        <input type="checkbox" name="group2" id="power point">
                        <label for="power point"><span class="checkbox">اسلاید</span></label>
                    </div>
                    <div class="container">
                        <input type="checkbox" name="group2" id="pdf">
                        <label for="pdf"><span class="checkbox">مقاله PDF</span></label>
                    </div>
                    <div class="container">
                        <input type="checkbox" name="group2" id="video">
                        <label for="video"><span class="checkbox">ویدیو</span></label>
                    </div>
                </section>
            </div>
            <div class="col-lg-3 offset-lg-2" id="costFilter">
                <div class="btn-group" role="group" aria-label="Basic example">
                    <ul class="donate-now" id="cost">
                        <li>
                            <input type="radio" id="free" name="amount" />
                            <label for="free">رایگان</label>
                        </li>
                        <li>
                            <input type="radio" id="not_free" name="amount" />
                            <label for="not_free">خریدنی</label>
                        </li>
                        <li>
                            <input type="radio" id="all" name="amount" checked="checked" />
                            <label for="all">همه</label>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

    <script>
        var buttons = $("#costFilter").find('button');

        for (var i = 0;i < buttons.length;i++) {
            $(buttons[i]).on('click', function () {
                restFilters();
                $(this).css('background', '#204056');
                $(this).css('color', '#fff');
            });
        }

        function restFilters() {
            for (var i = 0;i < buttons.length;i++){
                $(buttons[i]).css('background','#fff');
                $(buttons[i]).css('color','#000');
            }
        }

        console.log(buttons[0]);
    </script>
    <!------------------------ End Filter over cards ------------------------------>


    <!------------------------ course Cards ------------------------------>
    <div class="myCountainer">
        <!--Filter of courses-->

        <div class="row" id="Courses">
            <div class="col-xl-3 col-lg-3 col-md-3 push-xl-9 push-lg-9 push-md-9"  id="courseFilters">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">

                    <div class="row">
                        <div class="col-12" id="searchCourses">
                            <div>
                                <ul>
                                    <li style="display: inline-flex;">
                                        <button><i class="fa fa-search" aria-hidden="true"></i></button>
                                        <input class="form-control" type="search" placeholder="جست و جو" id="example-search-input">
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="courseSections">
                        <h3>دسته بندی محتواهای آماری</h3>
                        <section class="section courseFiltersCheckBtn" id="course_categories">
                            @foreach($course_categories as $course_category)
                                <div class="container">
                                    <input class="wiki_category" type="checkbox" name="group2" id="{{ $course_category->id }}">
                                    <label for="{{ $course_category->id }}"><span class="checkbox">{{ $course_category->name }}</span></label>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>
            <div id="LoadCourses" class="col-xl-9 col-lg-9 col-md-9 pull-xl-3 pull-lg-3 pull-md-3">
                @include('Main.LoadCourses')
            </div>
        </div>

    </div>

    <br><br>

    <!------------------------ End of course Cards ------------------------------>
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        <li><a href="{{ $share->url }}">{{ $share->name }}</a></li>
    @endforeach
@endsection

@section('footer-category')
    @foreach($rand_course_categories as $category)
        <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(function() {

            var CourseSearch = $("#example-search-input");
            var collect = {};
            var categoriesArray = [];
            var kindArray = [];
            var counter = 0;
            var kindCounter = 0;
            var SearchUrl = "http://amar7.dev/all-courses";

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#LoadCourses p').css('color', '#dfecf6');
                $('#LoadCourses').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            CourseSearch.on("keyup", function (event) {
                if(CourseSearch.val().length >=0  || event.keyCode == 8){
                    collect["query"] = CourseSearch.val();
                    console.log(collect);
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
            });

            $("#course_categories input[type=checkbox]").on("click", function (event) {
                if($(this).prop("checked")){
                    categoriesArray[counter] = $(this).attr("id");
                    collect["categories"] = categoriesArray;
                    counter++;
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
                if(!$(this).prop("checked")){
                    var temp = $(this).attr("id");
                    counter--;
                    $.each(categoriesArray, function( index, value ) {
                        if(value == temp) {
                            categoriesArray.splice(index, 1);
                        }
                    });
                    collect["categories"] = categoriesArray;
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
            });

            $("#second input[type=checkbox]").on("click", function (event) {
                if($(this).prop("checked")){
                    kindArray[kindCounter] = $(this).attr("id");
                    collect["kind"] = kindArray;
                    kindCounter++;
                    console.log(collect);
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
                if(!$(this).prop("checked")){
                    var temp = $(this).attr("id");
                    kindCounter--;
                    $.each(kindArray, function (index, value) {
                        if(value == temp){
                            kindArray.splice(index, 1);
                        }
                    });
                    console.log(collect);
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
            });

            $("#cost input[type=radio]").on("click", function () {
                collect["amount"] = $(this).attr("id");
                console.log(collect);
                getArticles(SearchUrl);
                window.history.pushState("", "", SearchUrl);
            });

            function getArticles(url) {
                $.ajax({
                    url : url,
                    data: collect
                }).done(function (data) {
                    $('#LoadCourses').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            }
        });

    </script>

    <script>
//        $( ".courseCard" ).click(function() {
//            $(this).find('.card-title a').trigger('click');
//            console.log("clecked:"+$(this).html());
//        });

// A $( document ).ready() block.
    $( document ).ready(function() {
        document.getElementsByClassName("card").addEventListener("click", function(){
            console.log("hi");
        });
        alert("hi");
        var cards = document.querySelectorAll(".card");
        for (var i = 0; i < cards.length; i += 2) {
            (function () {
                alert("r");
               cards[i].addEventListener("click",function () {
                  alert("jo");
               });
            }()); // immediate invocation
        }
    });

    </script>
@endsection