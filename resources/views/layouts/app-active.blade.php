@include('layouts.common.header')
<body>

<div class="container-fluid nav-box member-nav-box">
    <div class="row">
        <div class="col-sm-12">
            <div class="container">
                <div class="row">
                    <div class="col-sm-12">
                        <nav class="navbar navbar-expand-lg">
                            <a class="navbar-brand" href="{{url('/')}}">
                                {{--<img src="{{$gConfig['system']['white_logo']}}" height="37"--}}
                                     {{--alt="{{config('app.name')}}">--}}
                                {{env('APP_NAME')}}
                            </a>
                            <button class="navbar-toggler" type="button" data-toggle="collapse"
                                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent"
                                    aria-expanded="false" aria-label="Toggle navigation">
                                <i class="fa fa-bars"></i>
                            </button>

                            <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                <ul class="navbar-nav mr-auto">
                                    <li class="nav-item active">
                                        <a class="nav-link" href="{{url('/')}}">首页 <span
                                                    class="sr-only">(current)</span></a>
                                    </li>
                                    <li class="nav-item">
                                        <a class="nav-link" href="{{route('courses')}}">所有课程</a>
                                    </li>
                                    @foreach($gNavs as $item)
                                        <li class="nav-item">
                                            <a class="nav-link" href="{{$item['url']}}">{{$item['name']}}</a>
                                        </li>
                                    @endforeach
                                </ul>

                                <a class="role-vip-button {{menu_active('role.index')}}"
                                   href="{{route('role.index')}}">
                                    <p><img src="/images/icons/member/vip.png" width="24" height="24"></p>
                                    <p>会员中心</p>
                                </a>
                                @if($user)
                                    <div class="dropdown user-avatar">
                                        <a class="user-avatar-button" href="javascript:void(0);"
                                           id="navbarDropdown"
                                           role="button"
                                           data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                            <img src="{{$user['avatar']}}" width="40" height="40">
                                        </a>
                                        <div class="dropdown-menu" aria-labelledby="navbarDropdown">
                                            @if($user['role'] ?? [])
                                                <a class="dropdown-item vip"
                                                   href="{{route('member.join_role_records')}}">
                                                    <img src="/images/icons/vip.png" width="20"
                                                         height="20"><span>{{$user['role']['name']}}</span>
                                                </a>
                                            @else
                                                <a class="dropdown-item vip" href="{{route('role.index')}}">
                                                    <img src="/images/icons/vip.png" width="20"
                                                         height="20"><span>成为会员</span>
                                                </a>
                                            @endif
                                            <a class="dropdown-item" href="{{route('member')}}">
                                                <img src="{{$user['avatar']}}" width="20" class="avatar"
                                                     height="20"><span>用户中心</span>
                                            </a>
                                            <a class="dropdown-item" href="{{route('member.courses')}}">
                                                <img src="/images/icons/course.png" width="20"
                                                     height="20"><span>我的课程</span>
                                            </a>
                                            <a class="dropdown-item" href="{{route('member.orders')}}">
                                                <img src="/images/icons/order.png" width="20"
                                                     height="20"><span>订单信息</span>
                                            </a>
                                            <a class="dropdown-item" href="javascript:void(0);" onclick="event.preventDefault();
                                                             document.getElementById('logout-form').submit();">
                                                <img src="/images/icons/logout.png" width="20" height="20">
                                                <span>安全退出</span>
                                            </a>
                                            <form class="d-none" id="logout-form" action="{{ route('logout') }}"
                                                  method="POST"
                                                  style="display: none;">
                                                @csrf
                                            </form>
                                        </div>
                                    </div>

                                @else
                                    <a class="login-button-hover login-auth" href="{{route('login')}}"
                                       data-login="0">登录</a>
                                @endif
                            </div>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@yield('content')

@include('layouts.common.footer')

</body>
</html>