@extends('layouts.h5')

@section('content')

    <div class="container-fluid bg-fff">
        <div class="row">
            <div class="col-12 pt-5 pb-3 px-3">
                <h3 class="mb-5">账号注册</h3>
                <form action="" method="post" onsubmit="return formSubmitCheck();">
                    @csrf
                    <div class="form-group">
                        <label for="nick_name">昵称</label>
                        <input id="nick_name" type="text" class="form-control" placeholder="昵称"
                               name="nick_name" value="{{ old('nick_name') }}" required>
                    </div>
                    @include('frontend.components.mobile', ['smsCaptchaKey' => 'register'])
                    <div class="form-group">
                        <label for="password">密码</label>
                        <input id="password" type="password" class="form-control" placeholder="密码"
                               name="password" required>
                    </div>
                    <div class="form-group">
                        <label for="password-confirm">确认密码</label>
                        <input id="password-confirm" type="password" class="form-control"
                               placeholder="再输入一次" name="password_confirmation" required>
                    </div>
                    <div class="form-group">
                        <label><input type="checkbox"
                                      name="agree_protocol" {{ old('remember') ? 'checked' : '' }}> 我已阅读并同意
                            <a href="{{route('user.protocol')}}" target="_blank">《{{config('app.name')}}
                                用户协议》</a></label>
                    </div>
                    <div class="form-group mt-2">
                        <button class="btn btn-primary btn-block">注册</button>
                    </div>
                </form>
            </div>

            <div class="col-12 my-3 text-center">
                <a href="{{route('login')}}">点我登录</a>
            </div>

        </div>
    </div>

@endsection

@section('js')
    <script>
        function formSubmitCheck() {
            if ($('input[name="agree_protocol"]').is(':checked') === false) {
                alert('请同意用户协议');
                return false;
            }
            return true;
        }
    </script>
@endsection