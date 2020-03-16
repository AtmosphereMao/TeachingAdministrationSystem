@extends('layouts.app')

@section('content')

    <div class="container-fluid my-5">
        <div class="row">
            <div class="col-12 my-5">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-12 col-md-4 bg-fff pt-5 pb-3 px-5 br-8 box-shadow1 fs-14px">
                    <div class="card-body">
                        @if($res === false)
                            该链接已失效，请重新<a href="{{route('register')}}">注册>></a>
                        @else
                            您的账号已经激活，请<a href="{{route('login')}}">登录>></a>
                        @endif
                    </div>
                </div>
            </div>
        </div>
    </div>
        </div>
    </div>


@endsection
