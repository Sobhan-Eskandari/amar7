<!DOCTYPE html>
<html lang="fa">
<head>
    <meta charset="UTF-8">

    <title>@yield('title')</title>

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
        <a class="navbar-brand" href="{{ route('home') }}">
            <img src="../../images/Horoofnegar-blak.png" width="30" height="30" class="d-inline-block align-top" alt="">
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
                @if($user = \Illuminate\Support\Facades\Auth::user())
                    <li class="nav-item">
                        <a class="nav-link" href="{{ route('cart') }}" id="nav_cart">
                            <button>{{$count}}</button>
                            <i class="fa fa-cart-plus" aria-hidden="true"></i>
                        </a>
                    </li>
                @endif
                <li class="nav-item">
                    @if(\Illuminate\Support\Facades\Auth::Check())
                        <a href="{{ route('lessons.index') }}"><button id="navSignupBtn">داشبورد</button></a>
                    @else
                        <button id="navSignupBtn" class="nav-link" data-toggle="modal" data-target="#exampleModalLong">ثبت نام/ ورود </button>
                    @endif
                </li>
            </ul>
        </div>
    </nav>
</div>
<!-----------------------End of top header of site------------------------->

@yield('content')

<div class="col-xl-2 col-lg-2 col-md-3 col-sm-3 col-3 pull-right" id="sidebar_user">
    <img id="userImage" src="../UsersPhotos/{{ count($user->photos) != 0 ? $user->photos['0']['path'] : 'icone.png' }}">
    <h4>{{ $user->full_name }}</h4>
    <ul>
        <a href="{{ route('user-info') }}"><li @yield('info')><i class="fa fa-user" aria-hidden="true"></i> اطلاعات کاربر </li></a>
        <a href="{{ route('user-courses') }}"><li @yield('courses')><i class="fa fa-book" aria-hidden="true"></i> محتواهای آماری  </li></a>
        <a href="{{ route('user-password') }}"><li @yield('password')><i class="fa fa-lock" aria-hidden="true"></i> رمز عبور  </li></a>
            <a href="{{ url('/logout') }}"
               onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();"><li>
                <i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;خروج
                </li>
            </a>
            <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                {{ csrf_field() }}
            </form>
    </ul>
</div>
</div>
</div>

@yield('down-includes')

</body>
</html>