@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ایجاد مقاله
@endsection

@section('top-includes')
    <link href="../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../css/settings.css" rel="stylesheet" type="text/css" />
    <link href="../css/creatArticle.css" rel="stylesheet" type="text/css" />

    <script src="../js/jquery-2.1.4.min.js"></script>
    <script src="../js/bootstrap.min.js"></script>
    <link href="../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../js/bootstrap-select.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
@endsection

@section('content')

    @if(count($errors) > 0)
        <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px; margin-top: 1%">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12"  style="padding-right: 3%;padding-left: 3%;">
                <h2>ایجاد مقاله جدید</h2>
                <hr>
                {!! Form::open(['method'=>'POST', 'action'=>'WikiController@store', 'files' => true]) !!}

                    <h4>عنوان مقاله:</h4>
                    {!! Form::text('title', null, ['placeholder' => 'عنوان مقاله را وارد کنید']) !!}

                    <h4>عکس مقاله:</h4>

                    <div class="inputs">
                        <div class="fileUpload uploadImageBtn">
                            <span>آپلود عکس +</span>
                            <input name="img" id="uploadArticleImg" type="file" class="upload" />
                        </div>
                        <input id="articleUploadPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                    </div>

                    <div class="inputs">
                        <div class="fileUpload uploadImageBtn">
                            <span>آپلود فایل +</span>
                            <input name="file" id="uploadArticleFile" type="file" class="upload" />
                        </div>
                        <input id="articleUploadFilePlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                    </div>

                    <h4>نام استاد:</h4>
                    {!! Form::text('master_name', null, ['placeholder' => 'نام استاد را وارد کنید']) !!}

                    <div class="inputs">
                        <div class="fileUpload uploadImageBtn">
                            <span>آپلود عکس استاد +</span>
                            <input name="master_photo" id="uploadMasterPhoto" type="file" class="upload" />
                        </div>
                        <input id="uploadMasterPhotoPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                    </div>

                    <h4>متن مقاله:</h4>
                    {!! Form::textarea('body') !!}
                    <script>
                        CKEDITOR.replace( 'body',{
                            width: '80%',
                            height: 150
                        } );
                    </script>

                    <div class="row">

                        <div class="col-lg-1 col-md-2 col-xl-2 col-xs-12 col-lg-offset-5">
                            <h4>تگ:</h4>
                            {!! Form::select('tags[]',$tags, null, ['class'=>'selectpicker', 'multiple data-done-button'=>'true', 'data-live-search'=>'true']) !!}
                        </div>
                        <div class="col-xs-12 col-lg-3 col-lg-offset-3">
                            <h4>دسته بندی:</h4>
                            {!! Form::select('wiki_categories[]', $wiki_categories, null, ['class'=>'selectpicker', 'multiple data-done-button'=>'true', 'data-live-search'=>'true']) !!}
                            </div>
                    </div>
                {!! Form::submit('ایجاد مقاله', ['id'=>'creatArticle']) !!}
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('wiki')
    active
@endsection

@section('down-includes')

    <script src="../js/managementAddShop.js"></script>

    <script>
        document.getElementById("uploadArticleImg").onchange = function () {
            document.getElementById("articleUploadPlace").value = this.value;
        };

        document.getElementById("uploadArticleFile").onchange = function () {
            document.getElementById("articleUploadFilePlace").value = this.value;
        };

        document.getElementById("uploadMasterPhoto").onchange = function () {
            document.getElementById("uploadMasterPhotoPlace").value = this.value;
        };
    </script>

@endsection