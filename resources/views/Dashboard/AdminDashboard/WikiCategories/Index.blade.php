@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | دسته بندی مقالات
@endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/category.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{ Session::flash('name', isset($query) ? $query : '') }}
    <!---------------search form----------------->
    <div class="container">
        <div class="row searh_box">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                {!! Form::open(['method'=>'GET', 'action'=>'WikiCategoriesController@SearchCategories']) !!}
                    <div class="form-group">
                        <div class="input-group">
                            {!! Form::text('name', isset($_GET['name']) ? $_GET['name'] : '', ['class'=>'form-control inputSearch', 'id'=>'inputSearch', 'tabindex'=>'1', 'placeholder'=>'دسته بندی خود را جست و جو کنید']) !!}
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

    @if(Session::has('deleted_category'))
        <div class="alert alert-danger" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('deleted_category') }}</p>
        </div>
    @endif

    @if(Session::has('edited_category'))
        <div class="alert alert-warning" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('edited_category') }}</p>
        </div>
    @endif

    @if(Session::has('created_category'))
        <div class="alert alert-success" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('created_category') }}</p>
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

    <div class="row downer_from_menu">

        <div class="col-lg-6 col-md-6 col-xs-8 pdding_left">
            <label><h4>دسته بندی مقالات :</h4></label>
            <table class="table table-bordered">

                <tbody>
                @foreach($categories as $category)
                    <tr>
                        <td class="list">{{ $category->name }}</td>
                        <td class="edit"><a href="{{ route('wiki-categories.edit', $category->id) }}"><button style="border: none; background: none; color: black">ویرایش</button></a></td>
                        <td class="delet">
                            {!! Form::open(['method'=>'DELETE', 'action'=>['WikiCategoriesController@destroy', $category->id]]) !!}
                                {!! Form::submit('حذف', ['id'=>'delete', 'style'=>'border: none; background: none; color: red']) !!}
                            {!! Form::close() !!}
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
            {{ $categories->appends(Request::query())->links() }}
        </div>

        <div class="col-lg-6 col-md-6 col-xs-4  margin_right">
            {!! Form::open(['method'=>'POST', 'action'=>'WikiCategoriesController@store']) !!}
                <div class="row">
                    <div class="form-group">
                        <label><h4>دسته بندی :</h4></label>
                        {!! Form::text('name',null,['class'=>'form-control inputCategory','id'=>'inputCategory','tabindex'=>'1']) !!}
                    </div>
                </div>
                <div class="row">
                    {!! Form::submit('ساخت',['class'=>'btn record_btn']) !!}
                </div>
            {!! Form::close() !!}
        </div>



    </div>
@endsection

@section('wiki-categories')
    active
@endsection

@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
@endsection