@extends('master')
@section('header')
    @include('nav-header')
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
            <div>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Mobile and Mail Registration</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Details of Candidate</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Upload Photo & Signature</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Payment Information</a>
                <a class="btn btn-default btn-block btn-lg disabled" href="#">Download & Print Form</a>
            </div>
        </div>
        <div class="col-md-9">
             <i class="fa fa-3x">Welcome</i> <i class="fa fa-3x h1"> {{ $user->username }}</i>
            <hr>
            @if($user->mobile_active==1&&$user->email_active==1)

            @else
                <div class="alert alert-dismissible alert-info">
                    <i class="fa fa-warning"></i> Notice: Mobile activation code and Email activation code are different. Both mobile and email must be activated in order to fillup the CIT Entrance Application form.
                </div>
                @if($user->mobile_active==1)
                    <div class="alert alert-success">
                        Mobile is activated, Once you activate email you will be able to fillup your application form.
                    </div>
                @else
                    <div class="alert alert-warning">
                        Your mobile number must be activated. An SMS containing an activation code has been sent to your mobile.
                    </div>
                    <div class="form-group">
                        {!! Form::open(['method'=>'post','class'=>'form-horizontal form-inline','action'=>'Auth\AuthController@postMobileActivate']) !!}
                        {!! Form::label('mobile_code','Mobile Activation Code') !!}
                        {!! Form::text('mobile_code',null,['class'=>'form-control','placeholder'=>'Mobile activation code']) !!}
                        {!! Form::submit('Verify Mobile',['class'=>'btn btn-md btn-danger']) !!}
                        <a href="#" class="btn-link">Resend code</a> or <a href="#" class="btn-link">edit mobile</a>
                        {!! Form::close() !!}
                    </div>


                @endif
                @if($user->email_active==1)
                        <div class="alert alert-success">
                            Email is activated, Once you activate mobile you will be able to fillup your application form.
                        </div>
                @else
                    <div class="alert alert-warning">
                        Your email address must be activated. An email containing an activation code has been sent to your registered email address, please check in inbox.
                    </div>
                    <div class="form-group">
                        {!! Form::open(['method'=>'post','class'=>'form-horizontal form-inline','action'=>'Auth\AuthController@postEmailActivate']) !!}
                        {!! Form::label('email_code','Email Activation Code') !!}
                        {!! Form::text('email_code',null,['class'=>'form-control','placeholder'=>'Email activation code']) !!}
                        {!! Form::submit('Verify Email',['class'=>'btn btn-md btn-danger']) !!}
                        <a href="#" class="btn-link">Resend code</a> or <a href="#" class="btn-link">edit email</a>
                        {!! Form::close() !!}
                    </div>

                @endif
            @endif

        </div>


    </div>
@stop