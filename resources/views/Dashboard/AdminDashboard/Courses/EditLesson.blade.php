@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ویرایش محتوای آماری
@endsection

@section('top-includes')
    <link href="../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../css/creatPost.css" rel="stylesheet" type="text/css" />
    <link href="../../css/settings.css" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link href="../../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../../js/bootstrap-select.min.js"></script>
    <script src="../../js/ckeditor.js"></script>
@endsection

@section('content')
    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12">
                @if(count($errors) > 0)
                    <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
                        <ul>
                            @foreach($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif
                <h2>ویرایش محتوای آماری</h2>
                <hr>
                {!! Form::model($lesson,['method'=>'PATCH','action'=>['LessonController@update',$lesson->id],'files'=>true]) !!}
                {!! Form::text('lesson_name',null,['id'=>'postName','placeholder'=>'عنوان محتوای آماری را وارد کنید']) !!}<br>
                {!! Form::textarea('lesson_desc',null,['id'=>'editor1','rows'=>'10','cols'=>'80','placeholder'=>'توضیحات']) !!}

                    <div class="inputs">
                        <div class="fileUpload uploadImageBtn">
                            <span>آپلود عکس +</span>
                            {!! Form::file('lesson_img',['id'=>'uploadCourseImg','class'=>'upload']) !!}
                            {{--<input name="img" id="uploadCourseImg" type="file" class="upload" />--}}
                        </div>
                        <input id="courseImgUploadPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                    </div>

                    <hr>
                    <h4>درباره استاد</h4>
                {!! Form::text('instructor',null,['class'=>'attachmentInputs','placeholder'=>'نام استاد را وارد کنید']) !!}<br>
                {!! Form::textarea('instructor_desc',null,['id'=>'editor1','rows'=>'10','cols'=>'80','placeholder'=>'در مورد استاد']) !!}


                <div class="row">
                    <br>
                    <div class="col-xs-12 col-lg-3 col-md-3">
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-3">
                        <h4> رسانه:</h4>
                        {!! Form::select('media[]',['video'=>'video','power point'=>'power point','pdf'=>'pdf','mp3'=>'mp3'],$media,['class'=>'selectpicker','multiple']) !!}
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-3">
                        <h4> قیمت:</h4>
                        {!! Form::text('cost',null,['style'=>'width:80%']) !!}
                    </div>
                    <div class="col-xs-12 col-lg-3 col-md-3">
                        <h4>دسته بندی:</h4>
                        {!! Form::select('categories[]',$categories,$lesson->categories->pluck('id')->toArray(),['class'=>'selectpicker','multiple']) !!}
                    </div>
                    <br>
                    {!! Form::button('ایجاد محتوای آماری',['id'=>'creatArticle','type'=>'submit']) !!}
                </div>
                {!! Form::close() !!}
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
        document.getElementById("uploadCourseImg").onchange = function () {
            document.getElementById("courseImgUploadPlace").value = this.value;
        };
    </script>
@endsection