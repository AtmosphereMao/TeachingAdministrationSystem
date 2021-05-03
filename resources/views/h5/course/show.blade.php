@extends('layouts.h5')
@section('title', $course['title'])
@section('css')
    <style>
        body {
            padding-top: 40px;
        }
        .comment-box {
            width: 100%;
            height: auto;
            float: left;
            margin-bottom: 30px;
            margin-top: 10px;
        }
        .comment-input-box{
            width: 100%;
            height: auto;
            float: left;
            background-color: #fff;
            padding: 30px;
            -webkit-box-shadow: 0 4px 8px 0 #e5e5e5;
            box-shadow: 0 4px 8px 0 #e5e5e5;
            border-radius: 8px;
        }
        .comment-list-item{
            width: 100%;
            height: auto;
            float: left;
            margin-bottom: 10px;
            background: #fff;
            -webkit-box-shadow: 0 4px 8px 0 #e5e5e5;
            box-shadow: 0 4px 8px 0 #e5e5e5;
            border-radius: 8px;
            padding: 20px 30px;
        }
        .comment-user-avatar img{
            border-radius: 35px;
        }
        .comment-user-nickname{
            width: 100%;
            height: auto;
            float: left;
            font-size: 14px;
            font-weight: 600;
            color: #999;
            line-height: 14px;
            margin-bottom: 15px;
        }
        .comment-createAt{
            font-size: 12px;
            font-weight: 400;
            color: #ccc;
            line-height: 12px;
        }
    </style>
@endsection

@section('content')

    @include('h5.components.topbar', ['back' => route('courses'), 'title' => '课程详情'])

    <div class="course-thumb mb-3">
        <img src="{{$course['thumb']}}" width="100%" height="192">
    </div>
    <div class="container-fluid float-left py-4 bg-fff">
        <div class="row">
            <div class="col-12">
                <div class="course-info-box">
                    <div class="course-title">{{$course['title']}}</div>
                    <div class="course-info">
                        <span class="user_count">已有 {{$course['user_count']}} 人订购</span><br>
                        <span class="user_count">课程浏览数：{{$logCount}} 次</span>
                        <span class="price">{!! $course['charge'] ? "<small>￥</small>".$course['charge'] : "免费" !!}</span>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="course-detail-menu">
        <div class="course-menu-item active" style="width: 33%;" data-page="page-desc">
            <span>课程介绍</span>
        </div>
        <div class="course-menu-item" style="width: 33%;" data-page="page-chapter">
            <span>课程目录</span>
        </div>
        <div class="course-menu-item" style="width: 33%;" data-page="page-comment">
            <span>讨论区</span>
        </div>
    </div>

    <div class="w-100 float-left" style="margin-bottom: 70px;">
        <div class="container-fluid bg-fff py-3 float-left page-desc">
            <div class="row">
                <div class="col-12">
                    {!! $course['render_desc'] !!}
                </div>
            </div>
        </div>
        <div class="page-chapter">
            @if($chapters)
                @foreach($chapters as $chapter)
                    <div class="chapter-title"><span>{{$chapter['title']}}</span></div>
                    <div class="chapter-list-box">
                        @foreach($videos[$chapter['id']] ?? [] as $video)
                            <a href="{{route('video.show', [$video['course_id'], $video['id'], $video['slug']])}}"
                               class="chapter-list-item"><span>{{$video['title']}}</span>
                                <span class="video-duration float-right" style="margin-right: 10px;">{{duration_humans($video['duration'])}}</span>
                                @if($isBuy || $video['charge'] === 0)
                                    <span class="video-duration float-right"style="margin-right: 10px;">{{$progressData = progress_humans($progress, $video['id'], $video['duration'])}}</span>
                                @endif
                            </a>
                        @endforeach
                    </div>
                @endforeach
            @else
                <div class="chapter-list-box">
                    @foreach($videos[0] ?? [] as $video)
                        <a href="{{route('video.show', [$video['course_id'], $video['id'], $video['slug']])}}"
                           class="chapter-list-item"><span>{{$video['title']}}</span>
                            <span class="video-duration float-right" style="margin-right: 10px;">{{duration_humans($video['duration'])}}</span>
                            @if($isBuy || $video['charge'] === 0)
                                <span class="video-duration float-right"style="margin-right: 10px;">{{$progressData = progress_humans($progress, $video['id'], $video['duration'])}}</span>
                            @endif
                        </a>

                        <br>
                    @endforeach
                </div>
            @endif
        </div>
        <div class="page-comment" style="display: none">
            <div class="col-12">
                <div class="comment-box">
                    <div class="comment-input-box">
                        @if(\Illuminate\Support\Facades\Auth::check())
                        <textarea name="content" placeholder="请输入评论内容" class="form-control" rows="3"></textarea>
                        <button type="button" data-url="{{route('ajax.course.comment', [$course['id']])}}"
                                data-login="{{$user ? 1 : 0}}" data-input="content" class="comment-button btn btn-info float-right mt-3">评论
                        </button>
                        @else
                        <p>登陆后即可评论</p>
                        <button type="button"  class="btn btn-info" onclick="javascript:window.location.href='{{route('login')}}'">登录
                        </button>
                        @endif
                    </div>
                </div>

                <div class="comment-list-box">
                    @forelse($comments as $commentItem)
                        <div class="comment-list-item">
                            <div class="comment-user-avatar">
                                <img src="{{$commentUsers[$commentItem['user_id']]['avatar']}}" width="50"
                                     height="50">
                            </div>
                            <div class="comment-content-box">
                                <div class="comment-user-nickname">{{$commentUsers[$commentItem['user_id']]['nick_name']}}</div>
                                <div class="comment-content">
                                    {!! $commentItem['render_content'] !!}
                                </div>
                                <div class="comment-info">
                                    <span class="comment-createAt">{{\Carbon\Carbon::parse($commentItem['created_at'])->diffForHumans()}}</span>
                                </div>
                            </div>
                        </div>
                    @empty
                        @include('frontend.components.none')
                    @endforelse
                </div>
            </div>
        </div>
    </div>
    <script src="{{asset('frontend/js/frontend.js')}}">
    </script>

    @if(!$isBuy)
        <a href="{{route('member.course.buy', [$course['id']])}}" class="bottom-nav">订阅课程</a>
    @else
        <a href="javascript:void(0)" class="bottom-nav">已订阅</a>
    @endif

    @include('h5.components.recom_courses')

@endsection