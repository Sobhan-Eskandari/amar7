@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | تنظیمات
@endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/settings.css" rel="stylesheet" type="text/css" />

    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <link href="css/bootstrap-select.min.css" rel="stylesheet" type="text/css" />
    <script src="js/bootstrap-select.min.js"></script>
    <script src="//cdn.ckeditor.com/4.6.1/full/ckeditor.js"></script>
@endsection
@section('content')
    @if(Session::has('info_edit'))
        <div class="alert alert-warning" style="position:absolute;margin-left: 72%; margin-right: 64px">
            <p>{{ session('info_edit') }}</p>
        </div>
    @endif

    @if(Session::has('info_add'))
        <div class="alert alert-success" style="width:350px;margin-left: 72%; margin-right: 64px">
            <p>{{ session('info_add') }}</p>
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
    {!! Form::model($info,['method'=>'POST','action'=>'settingsController@store','files' => true]) !!}
    <div class="container height_vh">
        <div class="row height_vh">
            <div class="col-xs-12" style=" padding-right: 3.2% !important; padding-left: 5.5% !important;">
                <br><br>
                <div class="inputs">
                    <h4>هدر سایت</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('header_img',['class'=>'upload','id'=>'uploadHeader']) !!}
                        {{--<input id="uploadHeader" type="file" class="upload" />--}}
                    </div>
                    <input id="headerPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>
                {!! Form::textarea('header_txt',null,['placeholder'=>'متن خود را وارد کنید']) !!}
                <script>
                    CKEDITOR.replace( 'header_txt' );
                </script>
                <hr>
                <div class="inputs">
                    <h4>اسلایدر اول</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('thSlider_img',['class'=>'upload','id'=>'uploadSlide1']) !!}
                        {{--<input id="uploadSlide1" type="file" class="upload" />--}}
                    </div>
                    <input id="slide1Place" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>
                {!! Form::textarea('thSlider_txt',null,['placeholder'=>'متن خود را وارد کنید']) !!}
                {{--<textarea>متن خود را وارد کنید</textarea>--}}
                <hr>
                <div class="inputs">
                    <h4>اسلایدر دوم</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('ndSlider_img',['class'=>'upload','id'=>'uploadSlide2']) !!}
                        {{--<input id="uploadSlide2" type="file" class="upload" />--}}
                    </div>
                    <input id="slide2Place" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>
                {!! Form::textarea('ndSlider_txt',null,['placeholder'=>'متن خود را وارد کنید']) !!}
                <hr>
                <div class="inputs">
                    <h4>اسلایدر سوم</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('rdSlider_img',['class'=>'upload','id'=>'uploadSlide3']) !!}
                        {{--<input id="uploadSlide3" type="file" class="upload" />--}}
                    </div>
                    <input id="slide3Place" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>
                {!! Form::textarea('rdSlider_txt',null,['placeholder'=>'متن خود را وارد کنید']) !!}
                <hr>
                <div class="inputs">
                    <h4>تماس با ما</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('contactUs_img',['class'=>'upload','id'=>'uploadcontactus']) !!}

                        {{--<input id="uploadcontactus" type="file" class="upload" />--}}
                    </div>
                    <input id="contactusPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>شماره تماس</h4>
                        {!! Form::text('number',null) !!}
                        {{--<input name="number">--}}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>پست الکترونیکی</h4>
                        {!! Form::text('email',null) !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>تلگرام</h4>
                        {!! Form::text('telegram',null) !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>اینستاگرام</h4>
                        {!! Form::text('instagram',null) !!}
                    </div>
                </div>

                <div class="row">
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>فیسبوک</h4>
                        {!! Form::text('facebook',null) !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>توییتر</h4>
                        {!! Form::text('twitter',null) !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>آپارات</h4>
                        {!! Form::text('aparat',null) !!}
                    </div>
                    <div class="col-lg-6 col-md-6 col-xs-10">
                        <h4>لینکدین</h4>
                        {!! Form::text('linkedin',null) !!}
                    </div>

                </div>
                <hr>
                <div class="inputs">
                    <h4>درباره ما</h4>
                    <div class="fileUpload uploadImageBtn">
                        <span>آپلود عکس +</span>
                        {!! Form::file('aboutUs_img',['class'=>'upload','id'=>'uploadAboutUs']) !!}
                        {{--<input id="uploadAboutUs" type="file" class="upload" />--}}
                    </div>
                    <input id="aboutUsPlace" placeholder="انتخاب فایل" disabled="disabled" name="headerImage">
                </div>
                {!! Form::textarea('aboutUs_txt',null,['placeholder'=>'متن خود را وارد کنید']) !!}
                <script>
                    CKEDITOR.replace( 'aboutUs_txt' );
                </script>
            </div>
            {!! Form::button('ایجاد تغییرات',['type'=>'submit','id'=>'creatArticle']) !!}
        </div>

    </div>
    {!! Form::close() !!}
@endsection

@section('settings')
    active
@endsection

@section('down-includes')
    <script src="js/managementAddShop.js"></script>
    <script src="js/uploadfiles.js"></script>
@endsection