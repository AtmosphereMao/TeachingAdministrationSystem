@extends('layouts.h5')
@section('css')
    <style>
        .auth-box{
            position: fixed;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            z-index: 1111;
            background-color: rgba(0,0,0,.5);
            display: none;
        }
        #auth-box-content{
            margin-top: 200px;
            background-color: #fff;
            padding: 30px;
            border-radius: 8px;
        }
    </style>
@section('content')

    <script src="{{asset('frontend/js/frontend.js')}}"></script>
    <div class="auth-box">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-10" id="auth-box-content">
                </div>
            </div>
        </div>
    </div>
    <div class="container-fluid bg-fff">
        <div class="row">
            <div class="col-12">
                <div class="user-avatar">
                    <a href="javascript:void(0);" onclick="showAuthBox('avatar-change')" class="avatar-change-button">
                        <img src="{{$user['avatar']}}" width="80" height="80">
                    </a>
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
    <script id="avatar-change" type="text/html">
        <form class="login-box" action="{{route('ajax.avatar.change')}}" method="post">
            <div class="login-box-title" style="margin-bottom: 30px;">
                <span class="title">更换头像</span>
                <img src="/images/close.png" width="24" height="24" class="close-auth-box float-right">
            </div>
            <div class="alert alert-primary">
                <p class="mb-0">1.支持png,jpg,gif图片格式。</p>
                <p class="mb-0">2.图片大小不能超过1MB。</p>
            </div>
            <div class="form-group">
                <label>选择头像文件</label><br>
                <input type="file" name="file">
            </div>
            <div class="form-group auth-box-errors"></div>
            <div class="form-group mb-0">
                <button type="button" class="btn btn-primary btn-block avatar-change-button">更换头像</button>
            </div>
        </form>
    </script>
    @include('h5.components.navbar')

@endsection