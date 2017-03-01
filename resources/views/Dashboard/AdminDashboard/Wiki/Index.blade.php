@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | مقالات
@endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/users.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    {{ Session::flash('name', isset($query) ? $query : '') }}
    <!---------------search form----------------->
    <div class="container">
        <div class="row searh_box">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                {!! Form::open(['method'=>'GET', 'action'=>'WikiController@SearchWiki']) !!}
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::text('name', isset($_GET['name']) ? $_GET['name'] : '', ['class'=>'form-control inputSearch', 'id'=>'inputSearch', 'tabindex'=>'1', 'placeholder'=>'مقاله خود را جست و جو کنید']) !!}
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

    @if(Session::has('deleted_wiki'))
        <div class="alert alert-danger" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('deleted_wiki') }}</p>
        </div>
    @endif

    @if(Session::has('edited_wiki'))
        <div class="alert alert-warning" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('edited_wiki') }}</p>
        </div>
    @endif

    @if(Session::has('created_wiki'))
        <div class="alert alert-success" style="width:350px;margin-left: 80%; margin-right: 64px">
            <p>{{ session('created_wiki') }}</p>
        </div>
    @endif
    
    <!-----------table------------>

    <div class="row margin_right_2nd_title">
        <div class="col-md-3 col-md-offset-0 col-xs-8 pull-left">
            <a href="{{ route('wiki.create') }}"><button class="btn adv_btn pull-left">ایجاد مقاله&nbsp;<i class="fa fa-plus" aria-hidden="true"></i></button></a>
        </div>
        <div class="col-md-3 col-md-offset-0 col-xs-4 pull-right">
            <h4 class="list_title">مقالات</h4>
        </div>
    </div>
    <br>
    <div class="row">
        <div class="col-xs-12 table_padding">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>عنوان مقاله</th>
                    <th>تاریخ ایجاد</th>
                    <th>فیلتر مقاله</th>
                    <th></th>
                </thead>
                <tbody>
                @foreach($wikis as $wiki)
                    <tr>
                        <td class="upper_td">{{ $wiki->title }}</td>
                        <td class="upper_td">{{ $wiki->created_at->format('Y/m/d') }}</td>
                        <td class="upper_td">{{ $wiki->wiki_categories[0]['name'] }} و ...</td>
                        <td class="upper_td">

                            <div class="btn-group">
                                <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
                                    <div class="navbar-header">
                                        <div class="test">
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li><a  href="{{ route('wiki.edit', $wiki->id) }}">ویرایش</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['WikiController@destroy', $wiki->id]]) !!}
                                            {!! Form::submit('حذف', ['id'=>'delete', 'style' => 'background: none; border: none; margin-left:25px;']) !!}
                                        {!! Form::close() !!}
                                    </li>
                                </ul>
                            </div>

                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="row">
        <div class="col-lg-9 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0 padding_pagination">
            {{ $wikis->links() }}
        </div>
    </div>
@endsection

@section('wiki')
    active
@endsection

@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
@endsection