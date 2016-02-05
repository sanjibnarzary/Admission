@extends('master')
<!-- resources/views/auth/login.blade.php -->
@section('header')
    @include('nav-header')
@stop
@section('content')
    <div class="row">
        <div class="col-md-3">

        </div>
        <div class="col-md-6">
            <h1>Account Login</h1>
            @if(isset($error))
                <div class="alert alert-danger">
                    {{ $error }}
                </div>
            @endif
            <form method="POST" action="/auth/login">
                {!! csrf_field() !!}

                <div class="form-group">
                    Login
                    <input type="text" class="form-control" name="login" value="" placeholder="Username or Email or Form Number or Mobile Number">
                </div>

                <div class="form-group">
                    Password
                    <input type="password" class="form-control" name="password" id="password" placeholder="********">
                </div>

                <div class="form-group">
                    <input type="checkbox" class="checkbox-inline" name="remember"> Remember Me <a href="/auth/forgot">Forgot password?</a>
                </div>

                <div class="form-group">
                    <button type="submit" class="btn btn-block btn-lg btn-primary">Login</button>
                </div>
            </form>
            <div class="alert alert-success">
                <a href="/auth/register" class="btn-link">Don't have account? Create now..</a>
            </div>
        </div>

        <div class="col-md-3">

        </div>
    </div>
@stop