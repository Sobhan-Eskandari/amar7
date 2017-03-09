<!DOCTYPE html>
<html dir="rtl" lang="fa">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="description" content="تيم حروف نگار مجموعه اي خلاق است که تجربه ديجيتال نويني را عرضه ميکند">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>@yield('title')</title>

    <link rel="stylesheet" type="text/css" href="../../bower_components/font-awesome/css/font-awesome.min.css">
   <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    @yield('top-includes')

</head>
<body>

<div class="container-fluid height_vh">
    <div class="row height_vh">

        <!--main box(white)-->
        <div class="col-xs-10 scroll_padding">
            <!--menu_bar-->
            <div class="row menu_shadow">
                <div class="col-xs-4 pull-right home_top">
                    <h4><a href="{{ route('home') }}" class="zhenic_menubar"><i class="fa fa-home" aria-hidden="true"></i>&nbsp;موسسه دانش آماری</a></h4>
                </div>

                <div class="col-xs-4 pull-left exit_up">
                    <a href="{{ url('/logout') }}"
                        onclick="event.preventDefault();
                        document.getElementById('logout-form').submit();">
                    <h4><i class="fa fa-power-off" aria-hidden="true"></i>&nbsp;خروج</h4>
                    </a>
                    <form id="logout-form" action="{{ url('/logout') }}" method="POST" style="display: none;">
                        {{ csrf_field() }}
                    </form>
                </div>
            </div>

            <!--spline part-->
            <div class="scrollbar">
                <div class="row">
                    <div class="col-xs-12 spline">&nbsp;</div>
                </div>

                @yield('content')

            </div>
        </div>



        <!--sideBar-->
        <div class="col-xs-2 admin_sidebar pull-right">

            <a href="{{ route('home') }}"><h5 class="zhenic_title"><img src="../../../../images/amar7-logo2.png" alt="موسسه دانش آماری" style="width: 100px; height: 63px"></h5></a>

            <a href="{{ route('lessons.index') }}"><h5 class="admin_side_title @yield('courses')"><i class="fa fa-file-text-o set_fa  dropdownMenu pull-right" aria-hidden="true"></i><span class="hidden-xs">محتواهای آماری</span></h5></a>

            <a href="{{ route('wiki.index') }}"><h5 class="admin_side_title @yield('wiki')"><i class="fa fa-files-o set_fa pull-right" aria-hidden="true"></i><span class="hidden-xs"> مقالات</span></h5></a>

            <a href="{{ route('users.index') }}"><h5 class="admin_side_title @yield('users')"><i class="fa fa-user set_fa pull-right" aria-hidden="true"></i><span class="hidden-xs">کاربران</span></h5></a>

            <a href="{{ route('messages.index') }}"><h5 class="admin_side_title @yield('messages')"><i class="fa fa-bullhorn set_fa pull-right" aria-hidden="true"></i><span class="hidden-xs">پیام ها<span class="badge pull-left">{{ \App\Message::whereRead(0)->count() }}</span></h5></a>

            <a href="{{ route('courses-categories.index') }}"><h5 class="admin_side_title @yield('courses-categories')"><i class="fa fa-th-list set_fa pull-right" aria-hidden="true"></i><span class="hidden-xs">دسته بندی محتواها</span></h5></a>

            <a href="{{ route('wiki-categories.index') }}"><h5 class="admin_side_title @yield('wiki-categories')"><i class="fa fa-th-list set_fa pull-right" aria-hidden="true"></i><span class="hidden-xs">دسته بندی مقالات</span></h5></a>

            <a href="{{ route('reports.index') }}"><h5 class="admin_side_title left_space @yield('reports')"><i class="fa fa-gear set_fa pull-right xs_pr" aria-hidden="true"></i><span class="hidden-xs">گزارشات</span></h5></a>

            <a href="{{ route('tags.index') }}"><h5 class="admin_side_title left_space @yield('tags')"><i class="fa fa-gear set_fa pull-right xs_pr" aria-hidden="true"></i><span class="hidden-xs">تگ ها</span></h5></a>

            <a href="{{ route('settings.index') }}"><h5 class="admin_side_title left_space @yield('settings')"><i class="fa fa-gear set_fa pull-right xs_pr" aria-hidden="true"></i><span class="hidden-xs">تنظیمات</span></h5></a>

            <a href="{{ route('adminInfo') }}"><h5 class="admin_side_title left_space @yield('adminInfo')"><i class="fa fa-gear set_fa pull-right xs_pr" aria-hidden="true"></i><span class="hidden-xs">ویرایش اطلاعات</span></h5></a>

            <a href="{{ route('share.index') }}"><h5 class="admin_side_title left_space @yield('share')"><i class="fa fa-share-alt set_fa pull-right xs_pr" aria-hidden="true"></i><span class="hidden-xs">پیوندها</span></h5></a>

        </div>

    </div>

</div>

@yield('down-includes')

</body>

</html>