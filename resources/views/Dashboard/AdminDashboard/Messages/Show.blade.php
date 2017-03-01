@extends('layouts.DarskhanAdmin')

@section('title')
    موسسه دانش آماری | پاسخ به پیام
@endsection

@section('top-includes')
    <script src="../bower_components/jquery/dist/jquery.js"></script>
    <link href="../css/answerMessage.css" rel="stylesheet" type="text/css" />
    <link href="../css/dahboardSidebar.css" rel="stylesheet" type="text/css" />
@endsection

@section('content')
    <!----white box with scroll bar---->

    <!-----first panel(comments)---->
    <div class="row white_box_padding">
        <div class="col-xs-12">
            <div class="panel panel-default first_panel ">
                @if($message)
                <div class="panel-heading first_header_box">

                    <h4 class="heading_panel"><span class="glyphicon glyphicon-user user"></span>&nbsp;{{$message->name}}&nbsp;&nbsp;&nbsp;{{$message->created_at->format('Y/m/d')}}
                        <span class="pull-left">{{$message->email}}</span>
                    </h4>

                </div>

                <div class="panel-body first_panelBody">
                    <p>
                        {{$message->message}}
                    </p>

                </div>

            </div>
        </div>
    </div>
    <!----answer box---->
    {!! Form::open(['method'=>'POST','action'=>'MessageController@answerMessage']) !!}
    @if(count($errors) > 0)
        <div class="alert alert-danger" style="width:350px;margin-left: 72%; margin-right: 64px">
            <ul>
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <div class="col-6 form-group">
        <div class="row white_box_padding">
            <div class="col-xs-12">

                <div class="panel panel-default second_panel">
                    <div class="panel-heading second_header_box">

                        <h4 class="second_answer_head"> پاسخ به :{!! Form::text('email',$message->email,['style'=>'background-color:#252525; border: none; width: 500px;', 'readonly'=>'true']) !!}

                            <span class="pull-left subject_answer">
													<div class="form-group">
                                                        {!! Form::text('subject',null,['class'=>'form-control admin_holder col-sm-10','id'=>'inpuSubAns','placeholder'=>'موضوع پیام را وارد کنید']) !!}

													</div>
												</span>
                            <span class="pull-left">موضوع :&nbsp;&nbsp;&nbsp;</span>
                        </h4>
                    </div>


                    <!---send message button---->
                    <div class="form-group textOfAnswer">
                        {!! Form::textarea('message',null,['class'=>'form-control','id'=>'inputComments_answer', 'rows' => '1','placeholder'=>'متن پاسخ را وارد نمایید']) !!}
                    </div>

                </div>
                {!! Form::button('ارسال پیام',['type'=>'submit','id'=>'sendMessageBtn']) !!}
            </div>
        </div>
    </div>
    {!! Form::close() !!}
    @endif
@endsection

@section('messages')
    active
@endsection

@section('down-includes')
    <script src="../js/managementAddShop.js"></script>
@endsection