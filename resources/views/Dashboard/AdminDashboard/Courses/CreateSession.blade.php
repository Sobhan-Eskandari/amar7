@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ایجاد زیر محتوای آماری
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../css/creatPost.css" rel="stylesheet" type="text/css" />
    <link href="../../css/users.css" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link href="../../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../../js/bootstrap-select.min.js"></script>
    <link href="../../css/settings.css" rel="stylesheet" type="text/css" />
    <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12" style="padding-left: 3%; padding-right: 3%">
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

                @if(Session::has('created_session'))
                    <div class="alert alert-success" style="width:350px;margin-left: 72%; margin-right: 64px">
                        <p>{{ session('created_session') }}</p>
                    </div>
                @endif
                @if(count($errors) > 0)
                    <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>ایجاد زیر محتوای آماری جدید</h2>
                <hr>
                {!! Form::open(['method'=>'POST','action'=>['SessionController@store',$lesson->id],'files'=>true]) !!}
                {!! Form::text('session_name',null,['id'=>'postName','placeholder'=>'عنوان پست را وارد کنید']) !!}<br>
                {!! Form::textarea('session_desc',null,['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                    <script>
                        CKEDITOR.replace('session_desc');
                    </script>
                <h4>بارگذاری فایل</h4>
                {{--<input class="attachmentInputs" type="text" name="video">--}}
                {{--<button class="uploadImageBtn">بارگزاری +</button>--}}

                    <div class="inputs">
                        <div class="fileUpload uploadImageBtn">
                            <span> بارگزاری +</span>
                            {!! Form::file('session_file',['class'=>'upload','id'=>'uploadSesionImage']) !!}
                            {{--<input name="img" id="uploadSesionImage" type="file" class="upload" />--}}
                        </div>
                        <input id="sessionImagePlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                    </div>

                <br>
                <button id="creatArticle">ایجاد زیر محتوای آماری</button>
                    <hr>
                {!! Form::close() !!}


                <!-----------table------------>
                <div class="row margin_right_2nd_title">
                    <div class="col-md-3 col-md-offset-0 col-xs-4 pull-right">
                        <h4 class="list_title">جلسات</h4>
                    </div>
                </div>
                <br>
                <div class="row">
                    <div class="col-xs-12 table_padding">
                        <table class="table table-bordered" style="margin-bottom: 0">
                            <thead>
                            <tr>
                                <th>عنوان زیر محتوای آماری</th>
                                <th>تاریخ ایجاد</th>
                                <th>نام استاد</th>
                                <th>فیلتر پست</th>
                                <th></th>
                            </thead>
                            <tbody>
                            @if($sessions)
                                @foreach($sessions as $session)
                            <tr>
                                <td>{{$session->session_name}}</td>
                                <td class="upper_td">{{$session->date}}</td>
                                <td class="upper_td">{{$lesson->instructor}}</td>
                                <td class="upper_td">{{implode(',',$lesson->categories->pluck('name')->toArray())}}</td>
                                <td class="upper_td">

                                    <div class="btn-group">
                                        <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
                                            <div class="navbar-header">
                                                <div class="test">
                                                </div>
                                            </div>
                                        </a>
                                        <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                            <li><a  href="{{route('sessions.edit',['session_id'=>$session->id,'id'=>$lesson->id])}}">ویرایش</a></li>
                                            <li class="divider"></li>
                                            <li>
                                                {!! Form::open(['method'=>'DELETE','action'=>['SessionController@destroy','session_id'=>$session->id,'id'=>$lesson->id]]) !!}
                                                {!! Form::submit('حذف', ['id'=>'delete', 'style' => 'background: none; border: none; margin-left:55px;']) !!}
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
                    <div class="col-lg-8 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0 padding_pagination">
                        <ul class="pagination">

                            {!!  $sessions->appends(Request::query())->links()!!}

                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('courses')
    active
@endsection

@section('down-includes')
    <script src="../../js/managementAddShop.js"></script>

    <script>
        document.getElementById("uploadSesionImage").onchange = function () {
            document.getElementById("sessionImagePlace").value = this.value;
        };
    </script>
@endsection