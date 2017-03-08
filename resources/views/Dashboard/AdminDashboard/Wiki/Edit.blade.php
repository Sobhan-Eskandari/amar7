@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ویرایش مقاله
@endsection

@section('top-includes')
    <link href="../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../css/creatArticle.css" rel="stylesheet" type="text/css" />
    <link href="../../css/settings.css" rel="stylesheet" type="text/css" />

    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <link href="../../css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="../../js/bootstrap-select.min.js"></script>
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
                {!! Form::model($wiki , ['method'=>'PUT', 'action'=>['WikiController@update', $wiki->id], 'files' => true]) !!}

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

                    <div class="row">
                        <div class="col-lg-5 col-sm-6  pull-right">
                            <h5>  تغییر عکس استاد </h5>
                            <div class="inputs">
                                <div class="fileUpload uploadImageBtn">
                                    <p style="width: 120px; margin-bottom: 0%">آپلود عکس استاد +</p>
                                    <input name="master_photo" id="uploadMasterPhoto" type="file" class="upload" />
                                </div>
                                <input id="uploadMasterPhotoPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                            </div>
                        </div>
                        <div class="col-lg-5 col-sm-6 col-lg-offset-2">
                            <br><img style="width: 80px;height: 80px; border-radius: 50px" src="../../UsersPhotos/{{ count($wiki->master_photo) != 0 ? $wiki->master_photo : 'icone.png' }}">
                        </div>
                    </div>

                    {{--<div class="row">--}}
                        {{--<div class="col-lg-5 col-sm-6  pull-right">--}}
                            {{--<h5>  تغییر عکس استاد </h5>--}}
                            {{--<div class="inputs">--}}
                                {{--<div style="margin-right:0px; width: 35%;" class="fileUpload uploadImageBtn pull-right">--}}
                                    {{--<p style="margin-right: 0px; margin-top: -6px;">آپلود عکس +</p>--}}
                                    {{--<input name="img" id="uploaduserImg" type="file" class="upload" />--}}
                                {{--</div>--}}
                                {{--<input style="margin-top: 0px" id="userUploadPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">--}}
                            {{--</div>--}}
                        {{--</div>--}}
                        {{--<div class="col-lg-5 col-sm-6 col-lg-offset-2">--}}
                            {{--<br><img style="width: 80px;height: 80px; border-radius: 50px" src="../../UsersPhotos/icone.png">--}}
                            {{--<br><img style="width: 80px;height: 80px; border-radius: 50px" src="UsersPhotos/{{ count($user->photos) != 0 ? $user->photos['0']['path'] : 'icone.png' }}">--}}
                        {{--</div>--}}
                    {{--</div>--}}

                    <h4>متن مقاله:</h4>
                    {!! Form::textarea('body') !!}

                    <script>
                        CKEDITOR.replace( 'body' );
                    </script>

                    <div class="row">
                        <div class="col-lg-1 col-md-2 col-xl-2 col-xs-12 col-lg-offset-5">
                            {!! Form::submit('ویرایش مقاله', ['id'=>'creatArticle']) !!}
                        </div>
                        <div class="col-xs-12 col-lg-3 col-lg-offset-3">
                            <h4>دسته بندی:</h4>
                            {!! Form::select('wiki_categories[]', $wiki_categories, nonEmptyArray($wiki->wiki_categories->pluck('id')->toArray()) ? $wiki->wiki_categories->pluck('id')->toArray() : null, ['class'=>'selectpicker', 'multiple data-done-button'=>'true', 'data-live-search'=>'true']) !!}
                        </div>
                    </div>
                {!! Form::close() !!}
            </div>
        </div>
    </div>
@endsection

@section('wiki')
    active
@endsection

@section('down-includes')
    <script src="../../js/managementAddShop.js"></script>
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