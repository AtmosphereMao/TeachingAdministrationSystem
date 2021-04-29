@extends('layouts.h5')
@section('css')
    <link crossorigin="anonymous" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN"
          href="https://lib.baomitu.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('/frontend/css/frontend.css')}}">
    <style>
        body{
            padding-top: 5%;
        }
    </style>
@endsection
@section('content')
    @include('h5.components.topbar', ['back' => route('member'), 'title' => '我的订单'])
    <script src="{{asset('frontend/js/frontend.js')}}"></script>
    <div class="">
        <div class="row">
            <div class="">
                <div class="my-orders">
                    @forelse($orders as $order)
                        <div class="orders-item">
                            @if(count($order['goods']) > 1 || count($order['goods']) === 0)
                                <img src="/images/icons/order-goods.png" width="24" height="24">
                            @else
                                @switch($order['goods'][0]['goods_type'])
                                    @case(\App\Constant\FrontendConstant::ORDER_GOODS_TYPE_COURSE)
                                    <img src="/images/icons/course-hover.png" width="24" height="24">
                                    @break
                                    @case(\App\Constant\FrontendConstant::ORDER_GOODS_TYPE_ROLE)
                                    <img src="/images/icons/member/vip.png" width="24" height="24">
                                    @break
                                    @default
                                    <img src="/images/icons/order-goods.png" width="24" height="24">
                                @endswitch
                            @endif
                            <span class="order-goods-title">{{ implode(',', array_column($order['goods'] ?? [], 'goods_text')) }}</span>

                            <span class="order-goods-status member-list-item-right mr-3" style="width: 20%">{{$order['status_text']}}</span>
                            <span class="order-goods-payment member-list-item-right mr-3" style="width: 20%">{{$order['payment_text'] ?: '暂无'}}</span>
                            <span class="order-goods-date member-list-item-right mr-3" style="width: 20%">{{ \Carbon\Carbon::parse($order['created_at'])->format('Y-m-d') }}</span>
                            <span class="order-goods-charge member-list-item-right mr-3" style="width: 20%">￥{{ $order['charge'] }}</span>
                        </div>
                    @empty
                        @include('frontend.components.none')
                    @endforelse
                </div>
            </div>

            @if($orders->total() > $orders->perPage())
                <div class="col-12">
                    {!! str_replace('pagination', 'pagination justify-content-center', $orders->render()) !!}
                </div>
            @endif
        </div>
    </div>

@endsection