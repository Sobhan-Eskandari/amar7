@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ویرایش دسته بندی محتوای آماری
@endsection

@section('top-includes')
    <link href="../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../css/category.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <div class="row downer_from_menu">

        <div class="col-lg-6 col-md-6 col-xs-4  margin_right">
            {!! Form::model($courseCategory,['method'=>'PATCH','action'=>['CoursesCategoriesController@update',$courseCategory->id]]) !!}
                <div class="row">
                    <div class="form-group">
                        <label><h4>دسته بندی :</h4></label>
                        {!! Form::text('name',null,['class'=>'form-control inputCategory','id'=>'inputCategory','tabindex'=>'1']) !!}
                        {{--<input class="" type="text" id="inputCategory" tabindex="1">--}}
                    </div>
                </div>
                <div class="row">
                    <button class="btn record_btn">ویرایش</button>
                </div>
            {!! Form::close() !!}
        </div>
        @if(count($errors) > 0)
            <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
                <ul>
                    @foreach($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
    </div>
@endsection

@section('courses-categories')
    active
@endsection

@section('down-includes')
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/managementAddShop.js"></script>
@endsection