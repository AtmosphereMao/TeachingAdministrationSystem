@extends('layouts.h5')

@section('css')
    <link crossorigin="anonymous" integrity="sha384-K6LrEaceM4QP87RzJ7R4CDXcFN4cFW/A5Q7/fEp/92c2WV+woVw9S9zKDO23sNS+"
          href="https://lib.baomitu.com/Swiper/4.5.0/css/swiper.min.css" rel="stylesheet">
    <style>
    .announcement-box{
        width: 100%;
        height: 52px;
        float: left;
        background: #fff9d7;
        font-size: 16px;
        font-weight: 400;
        line-height: 52px;
        padding-left: 30px;
        padding-right: 30px;
    }
    .announcement-box a{
        color: #de7a0b;
    }
    </style>
@endsection

@section('content')

    <div class="swiper-container">
        <div class="swiper-wrapper">
            @foreach($sliders as $slider)
                <a class="swiper-slide" href="{{$slider['url']}}">
                    <img src="{{$slider['thumb']}}" width="100%" height="200">
                </a>
            @endforeach
        </div>
        <div class="swiper-pagination"></div>
    </div>
    @if($gAnnouncement)
        <div class="announcement-box">
            <a href="{{route('announcement.show', [$gAnnouncement['id']])}}">{{$gAnnouncement['title']}}</a>
        </div>
    @endif
    @foreach($banners as $banner)
        <div class="container-fluid bg-fff mt-10">
            <div class="row">
                <div class="col-12">
                    <div class="index-banner-box">
                        <div class="title">
                            <span>{{$banner['name']}}</span>
                        </div>
                        <div class="course-list-box">
                            @foreach($banner['courses'] as $course)
                                <a href="{{route('course.show', [$course['id'], $course['slug']])}}"
                                   class="course-list-item d-flex">
                                    <div class="course-thumb">
                                        <img src="{{$course['thumb']}}"
                                             width="122"
                                             height="70">
                                    </div>
                                    <div class="course-info-box w-100">
                                        <div class="course-title">{{$course['title']}}</div>
                                        <div class="course-info">
                                            <span>课时：{{$course['videos_count']}}节</span>
                                            <span class="price">{{$course['charge'] > 0 ? '￥' . $course['charge'] : '免费'}}</span>
                                        </div>
                                    </div>
                                </a>
                            @endforeach
                        </div>
                    </div>
                </div>
            </div>
        </div>
    @endforeach

    @include('h5.components.navbar')

    <script crossorigin="anonymous" integrity="sha384-fOtis9P3S4B2asdoye1/YBpXMaRmuXu925gZhfQA/gnU3dLnftD8zvpk/lhP0YSG"
            src="https://lib.baomitu.com/Swiper/4.5.0/js/swiper.min.js"></script>
    <script>
        new Swiper('.swiper-container', {
            autoplay: true,
            effect: 'fade',
            pagination: {
                el: '.swiper-pagination',
                clickable: true,
            },
        });
    </script>

@endsection