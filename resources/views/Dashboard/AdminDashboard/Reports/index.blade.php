@extends('layouts.DarskhanAdmin')
@section('title')
    موسسه دانش آماری | گزارشات
    @endsection

@section('top-includes')
    <link href="css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
    <link href="css/users.css" rel="stylesheet" type="text/css" />
    <style>
        #visitor_box{
            border: 1px solid gray;
            margin-bottom: 100px;
            padding: 20px;
        }
        #visitor_box p{
            text-align: center;
            margin: 20px 2px;
            font-size: 20px;
        }
        span{
            margin-left: 20px;
        }
    </style>
    @endsection

@section('content')

    <div class="container-fluid height_vh">
        <div class="row height_vh">
                    <!-----------table------------>
                    <div class="row margin_right_2nd_title">
                        <div class="col-md-3 col-md-offset-0 col-xs-8 pull-right">
                            <h3>گزارش خرید</h3>
                        </div>
                    </div>
                    <br>
                    <div class="row">
                        <div class="col-xs-12 table_padding">
                            <table class="table table-bordered">
                                <thead>
                                <tr>
                                    <th>نام خریدار</th>
                                    <th>نام محتوا</th>
                                    <th>تاریخ خرید</th>
                                    <th>قیمت</th>
                                    {{--<th></th>--}}
                                </thead>
                                <tbody>
                                @if($paginate)
                                @foreach($paginate as $item)
                                <tr>
                                    <td class="upper_td">{{$item['user']}}</td>
                                    <td class="upper_td">{{$item['lesson']}}</td>
                                    <td class="upper_td">{{str_replace('-','/',substr($item['time'], 0, strpos($item['time'],' ')))}}</td>
                                    <td class="upper_td">{{$item['cost']}}</td>
                                        @endforeach
                                @endif

                                </tbody>
                            </table>

                        </div>
                    </div>
                    <div class="row">
                        <div class="col-lg-8 col-lg-offset-0 col-md-8 col-md-offset-0 col-xs-11 col-xs-offset-0">
                            {{$paginate->links()}}
                        </div>
                    </div>

                    <hr>

                    <div class="container">
                        <div class="row">
                            <div class="col-xs-12 pull-right">
                                <h4>گزارش بازدید</h4>
                            </div>
                        </div>
                        <div class="row">
                            <div id="visitor_box" class="col-lg-3 col-xs-12 pull-right">
                                <p><span class="count">بازدید امروز:</span>{{ Counter::allHits(1) }} بازدید</p>
                                <p><span class="count">بازدید ماه:</span> {{ Counter::allHits(30) }} بازدید</p>
                                <p><span class="count">بازدید سال:</span> {{ Counter::allHits(365) }} بازدید</p>
                            </div>
                        </div>
                    </div>

                </div>
            </div>

    @endsection

@section('reports')
    active
@endsection
@section('down-includes')
    <script src="js/jquery-2.1.4.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script src="js/managementAddShop.js"></script>
    @endsection
