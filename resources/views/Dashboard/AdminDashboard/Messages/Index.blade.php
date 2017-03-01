@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | پیام ها
@endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/pms.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!---------------search form----------------->
    <div class="container">
        <div class="row searh_box">
            <div class="col-lg-6 col-lg-offset-3 col-md-8 col-md-offset-2 col-sm-8 col-sm-offset-2 col-xs-12 col-xs-offset-0">
                {!! Form::open(['method'=>'GET','action'=>'MessageController@search']) !!}
                    <div class="form-group">
                        <div class="input-group">
                            {!! Form::text('name',null,['class'=>'form-control inputSearch','id'=>'inputSearch','tabindex'=>'1','placeholder'=>'پیام خود را جست و جو کنید']) !!}
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
    <!-----------button----------->
    <div class="row">
        <div class="col-md-3 col-md-offset-0 col-xs-6 pull-left"></div>
    </div>

    <!-----------table------------>

    <br>
    <div class="row">
        <div class="col-xs-12 table_padding">
            <table class="table table-bordered">
                <thead>
                <tr>
                    <th><h4>پیام ها</h4></th>
                    <th></th>
                </tr>
                </thead>
                <tbody>
                @if($messages)
                {{--Haven't seen the meessage yet--}}
                    @foreach($messages as $message)
                        <tr class="{{$message->read==0 ? "gray_back_color" : ""}}">
                    <td>
                        <div class="row">
                            <div class="col-md-11 col-xs-10">
                                <div class="row">
                                                            <span class="pull-right one_row_table">
                                                                <h4 class="table_title">
                                                                    <span class="name_h">{{$message->name}} </span>
                                                                    &nbsp;|
                                                                    <span class="date">&nbsp;{{$message->created_at->format('Y/m/d')}} </span>
                                                                </h4>
                                                            </span>
                                </div>
                                <div class="row">
                                    <p class="more_exp_tb">
                                        {{str_limit($message->message, 100)}}
                                    </p>
                                </div>
                            </div>
                            <div class="col-md-1 col-xs-2">
                                <img src="../images/icone.png" class="icone_user ">
                            </div>
                        </div>
                    </td>

                    <td class="upper_td">

                        <div class="btn-group">
                            <a class=" dropdown-toggle" data-toggle="dropdown" href="#">
                                <div class="navbar-header">
                                    <div class="test">
                                    </div>
                                </div>
                            </a>
                            <ul class="dropdown-menu" role="menu" aria-labelledby="dropdownMenu" >
                                <li><a  href="{{route('messages.show',$message->id)}}">پاسخ</a></li>
                                <li class="divider"></li>
                                <li>
                                    {!! Form::open(['method'=>'DELETE','action'=>['MessageController@destroy',$message->id]])!!}
                                    {!! Form::submit('حذف', ['id'=>'delete', 'style' => 'background: none; border: none; margin-left:25px;']) !!}
                                    {!! Form::close() !!}
                                </li>
                            </ul>
                        </div>

                    </td>
                </tr>

                    @endforeach
                @endif


                </tbody>
            </table>

        </div>
    </div>

    <div class="row">
        <div class="col-lg-8 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0 padding_pagination">
            <ul class="pagination">

                {{$messages->appends(Request::query())->links()}}

            </ul>
        </div>
    </div>
@endsection

@section('messages')
    active
@endsection

@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
@endsection