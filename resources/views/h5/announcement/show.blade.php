@extends('layouts.h5')
@section('title', $a['title'])
@section('content')
    @include('h5.components.topbar', ['back' => route('index'), 'title' => $a['title']])
    <div class="container my-5">
        <div class="row">
            <div class="col-12">
                <div class="w-100 float-left bg-fff br-8 p-3">
                    <div class="announcement-title">
                        <h2>{{$a['title']}}</h2>
                        <p class="announcement-intro">
                            时间：{{$a['created_at']}} | 浏览次数：{{$a['view_times']}}
                        </p>
                    </div>
                    <div class="announcement-content">
                        {!! $a['announcement'] !!}
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection