@extends('master')

@section('header')
    @include('nav-header')
@stop
@section('content')

    {!! $page->body !!}

@stop