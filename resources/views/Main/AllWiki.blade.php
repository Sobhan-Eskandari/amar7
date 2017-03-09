@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | تمام مقالات
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

        .newCoursesTtle{
            width: auto;
            text-align: center;
            margin-bottom: 40px;
            margin-top: 20px;
            border-right: 2px solid gray;
            border-left: 2px solid gray;
        }

        .card-item:nth-of-type(1){
            background-color: #f65a5b;
        }

    </style>
@endsection

@section('content')

    </div>
    <!-----------------------End of top header of site------------------------->
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


        <div class="row">
            <div class="col-4 offset-4">
                <h2 class="newCoursesTtle">جدیدترین مقالات</h2>
            </div>
        </div>

        <div class="row" id="wikis">
            <!--Filter of courses-->
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
                        <h3>دسته بندی های مقالات</h3>
                        <section class="section courseFiltersCheckBtn" id="wiki_categories">
                            @foreach($wiki_categories as $wiki_category)
                                <div class="container">
                                    <input class="wiki_category" type="checkbox" name="group2" id="{{ $wiki_category->id }}">
                                    <label for="{{ $wiki_category->id }}"><span class="checkbox">{{ $wiki_category->name }}</span></label>
                                </div>
                            @endforeach
                        </section>
                    </div>
                </div>
            </div>

            <div id="LoadWikis" class="col-xl-9 col-lg-9 col-md-9 pull-xl-3 pull-lg-3 pull-md-3">
                @include('Main.LoadWikis')
            </div>
        </div>

    </div>


    <!------------------------ End of course Cards ------------------------------>

    <br><br>
@endsection

@section('footer-shares')
    @foreach($shares as $share)
        <li><a href="{{ $share->url }}" target="_blank">{{ $share->name }}</a></li>
    @endforeach
@endsection

@section('footer-category')
    @foreach($rand_wiki_categories as $category)
        <li><a href="{{ route('WikiCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')
    <script src="bower_components/bootstrap/dist/js/bootstrap.min.js"></script>

    <script type="text/javascript">

        $(function() {

            var WikiSearch = $("#example-search-input");
            var collect = {};
            var categoriesArray = [];
            var counter = 0;
            var SearchUrl = "http://amar7.dev/all-wiki";

            $('body').on('click', '.pagination a', function(e) {
                e.preventDefault();

                $('#LoadWikis p').css('color', '#dfecf6');
                $('#LoadWikis').append('<img style="position: absolute; left: 0; top: 0; z-index: 100000;" src="/images/loading.gif" />');

                var url = $(this).attr('href');
                getArticles(url);
                window.history.pushState("", "", url);
            });

            WikiSearch.on("keyup", function (event) {
                if(WikiSearch.val().length >=0  || event.keyCode == 8){
                    collect["query"] = WikiSearch.val();
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                }
            });

            $("#wiki_categories input[type=checkbox]").on("click", function (event) {
                if($(this).prop("checked")){
                    categoriesArray[counter] = $(this).attr("id");
                    collect["categories"] = categoriesArray;
                    counter++;
                    getArticles(SearchUrl);
                    window.history.pushState("", "", SearchUrl);
                    console.log(collect);
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

            function getArticles(url) {
                $.ajax({
                    url : url,
                    data: collect
                }).done(function (data) {
                    $('#LoadWikis').html(data);
                }).fail(function () {
                    alert('Articles could not be loaded.');
                });
            }
        });

    </script>
@endsection