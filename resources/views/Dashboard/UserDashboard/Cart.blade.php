@extends('layouts.DarskhanMain')

@section('title')
    موسسه دانش آماری | سبد خرید شما
@endsection

@section('top-includes')
    <link rel="stylesheet" type="text/css" href="bower_components/bootstrap/dist/css/bootstrap.css">
    <link rel="stylesheet" type="text/css" href="bower_components/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/footer.css">
    <link rel="stylesheet" href="css/navbar.css">
    <link rel="stylesheet" href="css/boughtLessons.css">
    <link rel="stylesheet" href="css/factor.css">
    <link rel="stylesheet" href="css/user_dashboard_sidebar.css">
    <script src="bower_components/jquery/dist/jquery.js"></script>
    <script src="bower_components/bootstrap/dist/js/bootstrap.js"></script>
    <link rel="stylesheet" type="text/css" href="css/loginSignupStyle.css">
@endsection

@section('content')
</div>
<!-----------------------End of top header of site------------------------->
<div class="container">
    <div class="row">
        <div class="col-4 offset-4">
            <h2 class="newCoursesTtle">سبد خرید شما</h2>
        </div>
    </div>
</div>
<div class="container-fluid">

    <div class="row">

        <div style="margin-bottom: 40px" class="col-xl-3 col-lg-3 col-md-3 col-sm-4 col-10">
            @if($lessons)
            <div class="col-12" id="cart_bar">
                <p>مبلغ قابل پرداخت :‌ {{$lessons->sum('cost')}} تومان</p>
                <hr>
                <div class="row">
                    <div class="col-xl-4 col-lg-4 col-md-12 col-sm-12 col-12">
                        <button id="addToCart"><i class="fa fa-cart-plus" aria-hidden="true"></i></button>
                    </div>
                    <div class="col-xl-8 col-lg-8 col-md-12 col-sm-12 col-12" id="confirmPurchaseBtn">
                        {!! Form::open(['method'=>'POST','action'=>'UserDashboardController@bought']) !!}
                        <button type="submit">تایید سفارش<i class="fa fa-check" aria-hidden="true"></i></button>
                        {!! Form::close() !!}
                    </div>
                </div>
            </div>
            @endif
        </div>

        <div style="margin-bottom: 40px" class="col-xl-9 col-lg-9 col-md-9 col-sm-8 col-12" >
            <div class="container">

                <div class="row hidden-md-down" id="headline">
                    <div class="col-xl-6 col-lg-6 col-md-12 offset-xl-1 offset-lg-1 pull-right">
                        <h5>مبلغ نهایی</h5>
                    </div>
                    <div class="col-xl-2 col-lg-2 col-md-12 offset-lg-3">
                        <h5> متحوای آماری</h5>
                    </div>
                </div>
                @if($lessons)
                    @foreach($lessons as $lesson)
                        @if($lesson->pivot->bought == 0)
                <div class="row factor" id="firstFactor">
                    <div class="col-xl-8 col-lg-8 col-md-12 push-lg-4  factor_right">
                        <img class="course_img hidden-xs-down" src="images/maghale_jpg.png">
                        <div class="factor_info">
                            <h4>{{$lesson->instructor}}</h4>
                            <ul>
                                <li><span class="line-brake">|</span></li>
                                <li>{{$lesson->lesson_name}}<span class="line-brake">|</span> {{$lesson->sessions ? count($lesson->sessions).' زیر محتوای آماری' : 'زیر محتوای آماری ندارد'}}</li>
                                <li></li>
                            </ul>
                        </div>

                    </div>
                    <div class="col-xl-3 col-lg-3 col-md-12 pull-lg-8 offset-lg-1 cost">
                        {!! Form::open(['method'=>'DELETE','action'=>['UserDashboardController@removeFromCart',$lesson->id]]) !!}
                        {!! Form::button('',['type'=>'submit','class'=>'deletBtn']) !!}
                        {!! Form::close() !!}
                        <h5>{{$lesson->cost}} تومان</h5>

                    </div>
                </div>
                        @endif
                    @endforeach
                @endif

            </div>

        </div>

    </div>
</div>
@endsection

@section('footer-category')
    @foreach($course_categories as $category)
        <li><a href="{{ route('CourseCategory', $category->id) }}">{{ $category->name }}</a></li>
    @endforeach
@endsection

@section('down-includes')

@endsection