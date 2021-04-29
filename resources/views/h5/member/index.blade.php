@extends('layouts.h5')

@section('content')

    <div class="container-fluid bg-fff">
        <div class="row">
            <div class="col-12">
                <div class="user-avatar">
                    <img src="{{$user['avatar']}}" width="80" height="80">
                </div>
                <div class="user-nickname">
                    {{$user['nick_name']}}
                    @if($user['role_id'] && \Carbon\Carbon::parse($user['role_expired_at'])->gt(\Carbon\Carbon::now()))
                        <small>{{$user['role']['name']}}</small>
                    @endif
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff mt-5 py-3">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a href="{{route('role.index')}}" class="user-menu-item">
                        <img src="/images/icons/vip.png" width="20" height="20">
                        <span class="title">会员中心</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff border-top py-3">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a href="{{route('member.courses')}}" class="user-menu-item">
                        <img src="/images/icons/course.png" width="20" height="20">
                        <span class="title">我的课程</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff border-top py-3">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a href="{{route('member.orders')}}" class="user-menu-item">
                        <img src="/images/icons/order.png" width="20" height="20">
                        <span class="title">我的订单</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff border-top py-3">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a href="{{route('member.promo_code')}}" class="user-menu-item">
                        <img src="/images/icons/profile.png" width="20" height="20">
                        <span class="title">我的邀请码</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff border-top py-3">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a href="{{route('member.password_reset')}}" class="user-menu-item">
                        <img src="/h5/images/icons/me.png" width="20" height="20">
                        <span class="title">修改密码</span>
                    </a>
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff py-3 mt-5">
        <div class="row">
            <div class="col-12">
                <div class="user-menu-box">
                    <a class="user-menu-item" href="javascript:void(0);" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                        <img src="/images/icons/logout.png" width="20" height="20">
                        <span class="title">安全退出</span>
                    </a>
                    <form class="d-none" id="logout-form" action="{{ route('logout') }}"
                          method="POST"
                          style="display: none;">
                        @csrf
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('h5.components.navbar')

@endsection