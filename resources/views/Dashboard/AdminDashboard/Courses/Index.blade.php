@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | محتواهای آماری
@endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/users.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!---------------search form----------------->
    <div class="container">
        <div class="row searh_box">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                {!! Form::open(['method'=>'GET','action'=>'LessonController@search']) !!}
                    <div class="form-group">
                        <div class="input-group">
                            {!! Form::text('name',null,['class'=>'form-control inputSearch','id'=>'inputSearch','placeholder'=>'محتوای آماری خود را جست و جو کنید']) !!}
                            <div class="input-group-addon">
                                <button type="submit" class="btn_search_inside">
                                    <i class="fa fa-search fa-lg" aria-hidden="true"></i>
                                </button>
                            </div>
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>

    <!-----------table------------>

    <div class="row margin_right_2nd_title">
        <div class="col-md-3 col-md-offset-0 col-xs-8 pull-left">
            <a href="{{route('lessons.create')}}" class="btn adv_btn pull-left">ایجاد محتوای آماری&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></a>
        </div>
        <div class="col-md-3 col-md-offset-0 col-xs-4 pull-right">
            <h4 class="list_title">محتواهای آماری</h4>
            @if(Session::has('deleted_lesson'))
                <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
                    <p>{{ session('deleted_lesson') }}</p>
                </div>
            @endif

            @if(Session::has('edited_lesson'))
                <div class="alert alert-warning" style="width:350px;margin-left: 72%; margin-right: 64px">
                    <p>{{ session('edited_lesson') }}</p>
                </div>
            @endif

            @if(Session::has('created_lesson'))
                <div class="alert alert-success" style="width:350px;margin-left: 72%; margin-right: 64px">
                    <p>{{ session('created_lesson') }}</p>
                </div>
            @endif
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 table_padding">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>عنوان محتوای آماری</th>
                    <th>تاریخ ایجاد</th>
                    <th>قیمت</th>
                    <th>نام نویسنده</th>
                    <th>رسانه</th>
                    <th></th>
                </thead>
                <tbody>
                @if($lessons)
                    @foreach($lessons as $lesson)
                <tr>
                    <td class="upper_td">{{$lesson->lesson_name}}</td>
                    <td class="upper_td">{{$lesson->date}}</td>
                    <td class="upper_td">{{$lesson->cost=='' ? 'رایگان' : $lesson->cost}}</td>
                    <td class="upper_td">{{$lesson->instructor}}</td>
                    <td class="upper_td">{{$lesson->media}}</td>
                    <td class="upper_td">

                        <div class="btn-group">
                            <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="navbar-header">
                                    <div class="test">
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                <li><a  href="{{route('sessions.create',$lesson->id)}}">اضافه کردن زیر محتوای آماری</a></li>
                                <li class="divider"></li>
                                <li><a  href="{{route('lessons.edit',$lesson->id)}}">ویرایش</a></li>
                                <li class="divider"></li>
                                <li>
                                    {!! Form::open(['method'=>'DELETE','action'=>['LessonController@destroy',$lesson->id]]) !!}
                                    {!! Form::submit('حذف',['id'=>'delete', 'style' => 'background: none; border: none; margin-left:55px;']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </div>

                    </td>
                </tr>
                        @endforeach
                    @endif
                </tbody>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-10 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0 padding_pagination">
            <ul class="pagination">

                {!!  $lessons->appends(Request::query())->links()!!}

            </ul>
        </div>
    </div>
@endsection

@section('courses')
    active
@endsection

@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
@endsection