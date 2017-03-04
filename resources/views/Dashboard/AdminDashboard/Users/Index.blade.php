@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | کاربران
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
                {!! Form::open(['method'=>'GET', 'action'=>'UserController@SearchUsers']) !!}
                <div class="form-group">
                    <div class="input-group">
                        {!! Form::text('name', isset($_GET['name']) ? $_GET['name'] : '', ['class'=>'form-control inputSearch', 'id'=>'inputSearch', 'tabindex'=>'1', 'placeholder'=>'کاربر خود را جست و جو کنید']) !!}
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

    @if(Session::has('deleted_user'))
        <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
            <p>{{ session('deleted_user') }}</p>
        </div>
    @endif

    @if(Session::has('edited_user'))
        <div class="alert alert-warning" style="width:350px;margin-left: 72%; margin-right: 64px">
            <p>{{ session('edited_user') }}</p>
        </div>
    @endif

    @if(Session::has('created_user'))
        <div class="alert alert-success" style="width:350px;margin-left: 72%; margin-right: 64px">
            <p>{{ session('created_user') }}</p>
        </div>
    @endif
    
    <!-----------table------------>

    <div class="row margin_right_2nd_title"></div>
    <br>
    <div class="row">
        <div class="col-xs-12 table_padding">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th>نام کاربر</th>
                    <th>شماره تماس</th>
                    <th>ایمیل</th>
                    <th>سطح دسترسی</th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @foreach($users as $user)
                    <tr>
                        <td>
                            <img src="UsersPhotos/{{ count($user->photos) != 0 ? $user->photos[0]['path'] : 'icone.png' }}" class="icone_user">
                            {{ $user->full_name }}
                        </td>
                        <td class="upper_td">{{ isset($user->cellphone) ? $user->cellphone : "کاربر شماره ندارد" }}</td>
                        <td class="upper_td">{{ $user->email }}</td>
                        <td class="upper_td">{{ $user->role['role'] }}</td>
                        <td class="upper_td">

                            <div class="btn-group">
                                <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
                                    <div class="navbar-header">
                                        <div class="test">
                                        </div>
                                    </div>
                                </a>
                                <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu">
                                    <li>
                                        {!! Form::open(['method'=>'DELETE', 'action'=>['UserController@destroy', $user->id]]) !!}
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
        <div class="col-lg-8 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0 padding_pagination">
            {{ $users->links() }}
        </div>
    </div>
@endsection

@section('users')
    active
@endsection

@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
@endsection