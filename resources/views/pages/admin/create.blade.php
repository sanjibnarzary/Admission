@extends('master')

@section('header')
    @include('nav-header')
@stop
@section('content')

    <form class="form" method="post">
        {!! csrf_field() !!}
        <label for="title">Title</label>
        <input type="text" name="title" class="form-control" id="title">
        <label for="body">Body</label>
        <textarea name="body" class="textarea"></textarea>
        <input type="hidden" name="admin_user_id" value="1">
        <button type="submit" class="btn btn-md btn-block btn-primary">Create Page</button>
    </form>
@stop