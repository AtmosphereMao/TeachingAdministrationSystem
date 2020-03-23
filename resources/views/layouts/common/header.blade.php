<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="keywords" content="{{$keywords ?? ''}}">
    <meta name="description" content="{{$description ?? ''}}">
    <title>
        @hasSection('title')
            {{$user ? $user['nick_name'].' - ' : ''}} @yield('title')
        @else
            {{$user ? $user['nick_name'].' - ' : ''}} {{env('APP_NAME')}}
        @endif
    </title>
    <link crossorigin="anonymous" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/frontend/css/frontend.css')}}">
    <script src="{{asset('frontend/js/frontend.js')}}"></script>
    @yield('css')
    @yield('js')
</head>