@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | ویرایش پیوند
@endsection

@section('top-includes')
    <link href="../../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="../../css/category.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')

    <div class="row downer_from_menu">

        <div class="col-lg-6 col-md-6 col-xs-4  margin_right">
            {!! Form::model($share , ['method'=>'PUT', 'action'=>['ShareController@update', $share->id]]) !!}
            <div class="row">
                <div class="form-group">
                    <label for="inputCategory"><h4>نام پیوند :</h4></label>
                    {!! Form::text('name',null,['class'=>'form-control inputCategory','id'=>'inputCategory','tabindex'=>'1']) !!}
                    <label for="inputCategory"><h4>آدرس پیوند :</h4></label>
                    {!! Form::text('url',null,['class'=>'form-control inputCategory','id'=>'inputCategory','tabindex'=>'1']) !!}
                </div>
            </div>
            <div class="row">
                {!! Form::submit('ویرایش',['class'=>'btn record_btn']) !!}
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

@section('share')
    active
@endsection

@section('down-includes')
    <script src="../../js/jquery-2.1.4.min.js"></script>
    <script src="../../js/bootstrap.min.js"></script>
    <script src="../../js/managementAddShop.js"></script>
@endsection