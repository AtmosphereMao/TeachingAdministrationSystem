@extends('layouts.h5')
@section('css')
    <link crossorigin="anonymous" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/frontend/css/frontend.css')}}">
    <style>
        .member-nav-box {
            background-color: #323232;
        }
        body{
            padding: 0;
        }
    </style>

@endsection

@section('content')
    @include('h5.components.topbar', ['back' => route('member'), 'title' => '会员中心'])
    <script src="{{asset('frontend/js/frontend.js')}}"></script>
    <div class="container-fluid role-center-banner">
        <div class="row">
            <div class="col-12 text-center">
                <img src="/images/role-center.png" width="203" height="44" class="mt-5">
                @if($user['role_id'] && \Carbon\Carbon::parse($user['role_expired_at'])->gt(\Carbon\Carbon::now()))
                    <div class="user-vip">
                        <div class="vip-logo-text" style="color: #ffcb00;">
                            {{$user['role']['name']}} {{\Carbon\Carbon::parse($user['role_expired_at'])->format('Y-m-d')}}
                            到期
                        </div>
                    </div>
                @else
                    <div class="user-vip">
                        <div class="vip-logo">
                            <img src="/images/icons/member/vip-logo-hover.png" width="100" height="100">
                        </div>
                        <div class="vip-logo-text">
                            您还未成为本站会员哦
                        </div>
                    </div>
                @endif
            </div>
        </div>
    </div>

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="role-list-box d-flex justify-content-center">
                    @foreach($gRoles as $index => $roleItem)
                        <div data-url="{{route('member.role.buy', [$roleItem['id']])}}"
                             class="role-list-item {{$index % 3 === 0 ? 'first' : ''}} ml-0">
                            <div class="name">{{$roleItem['name']}}</div>
                            <div class="price">
                                <small>￥</small>{{$roleItem['charge']}}</div>
                            <div class="desc">
                                @foreach($roleItem['desc_rows'] as $item)
                                    <p>{{$item}}</p>
                                @endforeach
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>

            <div class="col-12 text-center">
                <a data-login="{{$user ? 1 : 0}}" href="javascript:void(0)"
                   class="role-join-button login-auth">
                    @if($user['role_id'] && \Carbon\Carbon::parse($user['role_expired_at'])->gt(\Carbon\Carbon::now()))
                        续费会员
                    @else
                        开通会员
                    @endif
                </a>
            </div>
        </div>
    </div>

@endsection