@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ویرایش زیر محتوای آماری
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="../../../bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css" integrity="sha384-BVYiiSIFeK1dGmJRAkycuHAHRg32OmUcww7on3RYdg4Va+PmSTsz/K68vbdEjh4u" crossorigin="anonymous">
    <link href="../../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/creatPost.css" rel="stylesheet" type="text/css" />
    <link href="../../../css/users.css" rel="stylesheet" type="text/css" />

    <script src="../../../js/jquery-2.1.4.min.js"></script>
    <script src="../../../js/bootstrap.min.js"></script>
    <link href="../../../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../../../js/bootstrap-select.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
    <link href="../../../css/settings.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12" style="padding-left: 3%; padding-right: 3%">
                @if(count($errors) > 0)
                    <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>ویرایش زیر محتوای آماری جدید</h2>
                <hr>

                {!! Form::model($session,['method'=>'PATCH','action'=>['SessionController@update','id'=>$lesson->id,'session_id'=>$session->id],'files'=>true]) !!}
                    {!! Form::text('session_name',null,['id'=>'postName','placeholder'=>'عنوان پست را وارد کنید']) !!}<br>
                    {!! Form::textarea('session_desc',null,['id'=>'editor1','rows'=>'10','cols'=>'80']) !!}
                    <script>
                        CKEDITOR.replace('session_desc');
                    </script>
                <h4>بارگذاری آموزش ها</h4>

                    {{--{!! Form::file('session_file',['class'=>'uploadImageBtn']) !!}--}}


                    {!! Form::file('session_file',['class'=>'uploadImageBtn']) !!}
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
                    {!! Form::button('ویرایش زیر محتوای آماری',['id'=>'creatArticle','type'=>'submit']) !!}
                {{--<button id="creatArticle">ویرایش زیر محتوای آماری</button>--}}
                <hr>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('courses')
    active
@endsection

@section('down-includes')
    <script src="../../../js/managementAddShop.js"></script>
    <script>
        document.getElementById("uploadSesionImage").onchange = function () {
            document.getElementById("sessionImagePlace").value = this.value;
        };
    </script>
@endsection