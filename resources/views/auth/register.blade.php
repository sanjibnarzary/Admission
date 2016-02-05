@extends('master')
        <!-- resources/views/auth/register.blade.php -->
@section('header')
    @include('nav-header')
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">
        </div>

        <div class="col-md-6">
            <h1>Account Creation</h1>
            @if(isset($errors))
                @if(count($errors)>0)
                    <div class="alert alert-danger ">
                        @foreach($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </div>
                @endif
            @endif
            <form method="POST" action="/auth/register" data-toggle="validator">
                <input type="hidden" name="_method" value="post">
                <input type="hidden" name="_token" value="{{  csrf_token() }}">

                <div class="form-group">
                    Username
                    <input class="form-control" type="text" name="username" minlength="4" required value="" placeholder="Username (No space/special characters)">
                </div>

                <div class="form-group">
                    Email
                    <input class="form-control" type="email" name="email" value="" placeholder="Email address e.g., (example@gmail.com)">
                </div>
                <div class="form-group">
                    Mobile
                    <input class="form-control" type="tel" required name="mobile_number" minlength="10" maxlength="10" value="" placeholder="Mobile Number e.g., (9854698546)">
                </div>
                <div class="form-group">
                    Password
                    <input type="password" class="form-control" name="password" placeholder="*********">
                </div>

                <div class="form-group">
                    Confirm Password
                    <input type="password" class="form-control" name="password_confirmation" placeholder="*********">
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-primary btn-lg">Create an Account</button>
                </div>
            </form>
            <div class="alert alert-success">
                 <a href="/auth/login" class="btn-link">Already have account? Sign-in/Login to Fill up the form.</a>
            </div>
        </div>

        <div class="col-md-3">
        </div>
    </div>
@stop