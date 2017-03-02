<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">

    <title>@yield('title')</title>
    <meta charset="ISO-8859-1">
    <link rel="stylesheet" href="../../css/search.css">
    <link rel="stylesheet" href="../../css/bootstrap.min.css">
    <script src="../../js/bootstrap.min.js"></script>
    <script type="text/javascript">
        var onloadCallback = function() {
            grecaptcha.render('grecaptcha-popup-login', {
                'sitekey' : '6Ld0ORcUAAAAAPzsIvkNhrT_QcrJP96w4-CblMyK',
                'theme' : 'light'
            });
            grecaptcha.render('grecaptcha-popup-signup', {
                'sitekey' : '6Ld0ORcUAAAAAPzsIvkNhrT_QcrJP96w4-CblMyK',
                'theme' : 'light'
            });

            @yield('header-recaptcha')
        };
    </script>
    @yield('top-includes')

</head>
<body>

<!------------------------top header of site------------------------------>
<div class="jumbotron jumbotron-fluid">
    <!--navbar of site-->
    <nav class="navbar navbar-toggleable-md navbar-light bg-faded">
        <button class="navbar-toggler navbar-toggler-right" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarNavDropdown" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <a class="navbar-brand" href="#">
            <img src="../images/Horoofnegar-blak.png" width="30" height="30" class="d-inline-block align-top" alt="">
        </a>
        <div class="collapse navbar-collapse" id="navbarNavDropdown">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link" href="{{ route('home') }}">خانه <span class="sr-only">(current)</span></a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('allCourses') }}">تمام محتواهای آماری</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link" href="{{ route('allWiki') }}">مقالات</a>
                </li>
                <li class="nav-item">
                    <a id="flip" class="nav-link" href="#">جستجو <i class="fa fa-search" aria-hidden="true"></i></a>
                </li>
                @if(\Illuminate\Support\Facades\Auth::check())
                    @if(\Illuminate\Support\Facades\Auth::user()->UserRole())
                        <li class="nav-item">
                             <a class="nav-link" href="{{ route('cart') }}" id="nav_cart">
                                <button>{{$count}}</button>
                                 <i class="fa fa-cart-plus" aria-hidden="true"></i>
                            </a>
                        </li>
                    @endif
                @endif
                <li class="nav-item">
                    @if(\Illuminate\Support\Facades\Auth::Check())
                        @if(Auth::user()->AdminRole())
                            <a href="{{ route('lessons.index') }}"><button id="navSignupBtn">داشبورد</button></a>
                        @elseif(Auth::user()->UserRole())
                            <a href="{{ route('user-info') }}"><button id="navSignupBtn">داشبورد</button></a>
                        @endif
                    @else
                        <button id="navSignupBtn" class="nav-link" data-toggle="modal" data-target="#exampleModalLong">ثبت نام/ ورود </button>
                    @endif
                </li>
            </ul>
        </div>
    </nav>

    <div id="panel">
        <div class="col-md-10  col-xs-9 pull-right">
            <div class="form-group">
                <div class="input-group">
                    {{--<div class="input-group-addon"> <i cl'Asass="fa fa-search fa-lg" aria-hidden="true"></i> </div>--}}
                    {!! Form::open(['method'=>'GET','action'=>'SiteController@search','style'=>'width: 100%']) !!}
                    <input style="width: 100%" name="name" class="form-control inputSearchNav" type="text" id="inputSearchNav" tabindex="1" placeholder="عبارت مورد جستجو را وارد کنید"> </div>
            </div>
        </div>
        <div class="col-md-2  col-xs-3 pull-left">
            <button class="btn search_btn_nav pull-right"> <i class="fa fa-search fa-2x" aria-hidden="true"></i> </button>
        </div>
        {{Form::close()}}
    </div>

    @yield('content')
<!------------------------------ Signin Signup Modal ------------------------------>
    <div class="modal fade" id="exampleModalLong" tabindex="-1" role="dialog" aria-labelledby="exampleModalLongTitle" aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content" id="signup_login_panel">

                <ul class="nav nav-tabs" role="tablist">
                    <li class="nav-item">
                        <a class="nav-link" data-toggle="tab" href="#loginpanel" role="tab">ورود</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link active" data-toggle="tab" href="#signup" role="tab">ثبت نام</a>
                    </li>
                </ul>

                <!-- Tab panes -->
                <div class="tab-content">
                    <div class="tab-pane" id="loginpanel" role="tabpanel">
                        {!! Form::open(['method' => 'POST', 'action' => 'Auth\LoginController@login']) !!}
                            <div class="row">
                                <div class="col-12 offset-1">
                                    <input id="loginmail" type="email" placeholder="&#xF0e0;  رایانامه" style="font-family:BYekan,FontAwesome" name="email" value="{{ old('email') }}" required>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-12 offset-1">
                                    <input type="password" placeholder="&#xF023;  گذرواژه" style="font-family:BYekan,FontAwesome" name="password" required>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-4 offset-4 rememberMe">
                                    <p> مرا به خاطر نگه دار <input type="checkbox" name="remember" {{ old('remember') ? 'checked' : ''}}></p>
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

                    <div class="tab-pane active" id="signup" role="tabpanel">
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
                                <input id="mail" type="password" placeholder="&#xF023;  گذرواژه" style="font-family:BYekan,FontAwesome" name="password">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-11 offset-1" style="margin-left: 12%;">
                                <input id="mail" type="text" placeholder="&#xF0e0;  رایانامه" style="font-family:BYekan,FontAwesome" name="email">
                            </div>
                        </div>

                        <div class="row">
                            <div style="margin-top: 10px;margin-bottom: 10px" class="col-10 offset-2" id="grecaptcha-popup-signup"></div>
                        </div>

                        <div class="row" id="signupBtn">
                            <div class="col-12">
                                <button>ثبت نام</button>
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
    <!------------------------ Footer ------------------------------>
    <footer>
        <div class="container-fluid">
            <div class="row footerPart">
                <div class="col-lg-3 col-md-3 col-sm-3 footerLogoPart">
                    <img src="../images/Horoofnegar-blak.png">
                    <p>حروف نگار</p>
                </div>
                <div style="margin-left: 12%" class="col-lg-3 col-md-3 col-sm-3 offset-lg-1 offset-md-1 offset-sm-1 offset-1 socialNetworks">
                    <p>شبکه های اجتماعی</p>
                    <ul>
                        <li><a href="{{  isset($info->aparat) ? $info->aparat : 'http://www.aparat.com/' }}"><img src="../images/aparat.png"></a></li>
                        <li><a href="{{  isset($info->telegram) ? $info->telegram : 'https://telegram.org/' }}"><img src="../images/telegram.png"></a></li>
                        <li><a href="{{  isset($info->twitter) ? $info->twitter : 'https://twitter.com/?lang=en' }}"><img src="../images/twitter.png"></a></li>
                        <li><a href="{{  isset($info->facebook) ? $info->facebook : 'http://www.facebook.com/' }}"><img src="../images/facebook.png"></a></li>
                        <li><a href="{{  isset($info->linkedin) ? $info->linkedin : 'linkedin.com' }}"><img src="../images/linkdin.png"></a></li>
                    </ul>
                </div>
                <div class="col-lg-3 col-md-3 col-sm-3 offset-lg-1 offset-md-1 offset-sm-1 footer_categories">
                    <div class="row">
                        <div class="col-6">
                            <p>دسته بندی ها</p>
                            <ul>
                                @yield('footer-category')
                            </ul>
                        </div>
                        <div class="col-6">
                            <p> منوها</p>
                            <ul>
                                <li><a href="{{ route('home') }}">خانه</a></li>
                                <li><a href="{{ route('allCourses') }}">محتواهای آماری</a></li>
                                <li><a href="{{ route('allWiki') }}">مقالات</a></li>
                                <li><a href="{{ route('aboutUs') }}">درباره ما</a></li>
                                <li><a href="{{ route('contact-us') }}">تماس با ما</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12">
                    <p id="copyright">کلیه حقوق مادی و معنوی این وبسایت متعلق به گروه حروف نگار می باشد - 1395</p>
                </div>
            </div>
        </div>

    </footer>
    <!------------------------ End of Footer ------------------------------>
    <script src="../../js/script.js"></script>
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="https://www.google.com/recaptcha/api.js?onload=onloadCallback&render=explicit&hl=fa"
            async defer>
    </script>

    @yield('down-includes')

</body>

</html>