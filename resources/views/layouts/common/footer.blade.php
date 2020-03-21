<div class="auth-box">
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-4" id="auth-box-content">
            </div>
        </div>
    </div>
</div>

<script type="text/html" id="login-box">
    <form class="login-box" action="{{route('ajax.login.password')}}" method="post">
        <div class="login-box-title">
            <span class="title">登录</span>
            <img src="/images/close.png" width="24" height="24" class="close-auth-box">
        </div>
        <div class="login-box-content">
            <div class="form-group">
                <input type="text" class="form-control" name="email" placeholder="请输入邮箱">
            </div>
            <div class="form-group">
                <input type="password" class="form-control" name="password" placeholder="请输入密码">
            </div>
            <div class="form-group login-remember">
                <label class="remember"><input type="checkbox" name="remember"> 15天内免登录</label>
                {{--<span class="show-find-password" onclick="showAuthBox('password-find')">忘记密码</span>--}}
                <span class="show-register-box float-right" onclick="showAuthBox('register-box')">立即注册</span>
            </div>
            <div class="form-group auth-box-errors"></div>
            <div class="form-group mt-2">
                <button type="button" class="btn btn-primary btn-block login-password-button">立即登录</button>
            </div>
            <div class="form-group text-center mb-0 socialite-box">
                @foreach(enabled_socialites() as $socialite)
                    <a class="socialite-item"
                       href="{{route('socialite', $socialite['app'])}}"><img src="{{$socialite['logo']}}" width="44"
                                                                             height="44"></a>
                @endforeach
            </div>
        </div>
    </form>
</script>


{{--<script type="text/html" id="password-find">--}}
    {{--<form class="login-box" action="{{route('ajax.password.reset')}}" method="post">--}}
        {{--@csrf--}}
        {{--<div class="login-box-title" style="margin-bottom: 30px;">--}}
            {{--<span class="title">找回密码</span>--}}
            {{--<img src="/images/close.png" width="24" height="24" class="close-auth-box">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<input type="text" class="form-control" name="mobile" placeholder="请输入手机号">--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="captcha" placeholder="验证码" class="form-control" required>--}}
                {{--<div class="input-group-append">--}}
                    {{--<img src="{{ captcha_src() }}" class="captcha" width="120" height="48">--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<div class="input-group">--}}
                {{--<input type="text" name="sms_captcha" placeholder="手机验证码" class="form-control" required>--}}
                {{--<input type="hidden" name="sms_captcha_key" value="password_reset">--}}
                {{--<div class="input-group-append">--}}
                    {{--<button type="button" style="width: 120px;"--}}
                            {{--class="send-sms-captcha btn btn-outline-primary">发送验证码--}}
                    {{--</button>--}}
                {{--</div>--}}
            {{--</div>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<input id="password" type="password" class="form-control" placeholder="新密码"--}}
                   {{--name="password" required>--}}
        {{--</div>--}}
        {{--<div class="form-group">--}}
            {{--<input id="password-confirm" type="password" class="form-control"--}}
                   {{--placeholder="再输入一次" name="password_confirmation" required>--}}
        {{--</div>--}}
        {{--<div class="form-group auth-box-errors"></div>--}}
        {{--<div class="form-group mb-0">--}}
            {{--<button type="button" class="btn btn-primary btn-block password-reset-button">重置密码</button>--}}
        {{--</div>--}}
    {{--</form>--}}
{{--</script>--}}

<script id="register-box" type="text/html">
    <form class="login-box" action="{{route('ajax.register')}}" method="post">
        @csrf
        <div class="login-box-title" style="margin-bottom: 30px;">
            <span class="title">注册</span>
            <img src="/images/close.png" width="24" height="24" class="close-auth-box">
        </div>
        <div class="form-group">
            <input id="nick_name" type="text" class="form-control" placeholder="昵称暂不支持修改，请慎重取名哦"
                   name="nick_name" value="{{ old('nick_name') }}" required>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="email" placeholder="请输入邮箱">
        </div>
        <div class="form-group">
            <input id="password" type="password" class="form-control" placeholder="密码"
                   name="password" required>
        </div>
        <div class="form-group">
            <input id="password-confirm" type="password" class="form-control"
                   placeholder="再输入一次" name="password_confirmation" required>
        </div>
        <div class="form-group login-remember">
            <label class="user_protocol"><input type="checkbox"
                                                name="agree_protocol" {{ old('remember') ? 'checked' : '' }}>
                我已阅读并同意
                <a href="{{route('user.protocol')}}" target="_blank">《{{config('app.name')}}
                    用户协议》</a></label>

            <span class="float-right show-login-box" onclick="showAuthBox('login-box')">立即登录</span>
        </div>
        <div class="form-group auth-box-errors"></div>
        <div class="form-group mb-0">
            <button type="button" class="btn btn-primary btn-block register-button">立即注册</button>
        </div>
    </form>
</script>

<script id="mobile-bind-box" type="text/html">
    <form class="login-box" action="{{route('ajax.mobile.bind')}}" method="post">
        <div class="login-box-title" style="margin-bottom: 30px;">
            <span class="title">手机号绑定</span>
        </div>
        <div class="form-group">
            <input type="text" class="form-control" name="mobile" placeholder="请输入手机号">
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="captcha" placeholder="验证码" class="form-control" required>
                <div class="input-group-append">
                    <img src="{{ captcha_src() }}" class="captcha" width="120" height="48">
                </div>
            </div>
        </div>
        <div class="form-group">
            <div class="input-group">
                <input type="text" name="sms_captcha" placeholder="手机验证码" class="form-control" required>
                <input type="hidden" name="sms_captcha_key" value="mobile_bind">
                <div class="input-group-append">
                    <button type="button" style="width: 120px;"
                            class="send-sms-captcha btn btn-outline-primary">发送验证码
                    </button>
                </div>
            </div>
        </div>
        <div class="form-group auth-box-errors"></div>
        <div class="form-group mb-0">
            <button type="button" class="btn btn-primary btn-block mobile-bind-button">立即绑定</button>
        </div>
    </form>
</script>

<footer class="container-fluid footer-box">
    <div class="container">
        <div class="row">
            <div class="col-12 text-center">
                <p>© {{date('Y')}} {{config('app.name')}} · <a href="http://www.beian.miit.gov.cn"
                                                               target="_blank">{{$gConfig['system']['icp']}}</a></p>
                <p>总访客量：{{\App\Services\Course\Models\CourseVisitor::All()->count()}}</p>
            </div>
        </div>
    </div>
</footer>

<script>
    @if(get_first_flash('success'))
    flashSuccess("{{get_first_flash('success')}}");
    @endif
    @if(get_first_flash('warning'))
    flashWarning("{{get_first_flash('warning')}}");
    @endif
    @if(get_first_flash('error'))
    flashError("{{get_first_flash('error')}}");
    @endif
</script>
<script>
    function showAuthBox($box) {
        $('#auth-box-content').html($('#' + $box).html());
        $('.auth-box').show();
    };
</script>
@if($bindMobileState)
    <script>
        showAuthBox('mobile-bind-box');
    </script>
@endif
@yield('js')
<div style="display:none">{!! config('meedu.system.js') !!}</div>