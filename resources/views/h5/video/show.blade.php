@extends('layouts.h5')
@section('title', $course['title'].' - '.$video['title'])
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

    @include('h5.components.topbar', ['back' => route('course.show', [$course['id'], $course['slug']]), 'title' => '详情'])
    <link href="https://unpkg.com/video.js/dist/video-js.css" rel="stylesheet">
    <script src="https://unpkg.com/video.js/dist/video.js"></script>
    <div class="video-play-box" style="height: 100%">
        @if($user)
            @if($canSeeVideo)
                    @if($video['aliyun_video_id'])
                        @include('h5.components.player.aliyun', ['video' => $video])
                    @elseif($video['tencent_video_id'])
                        @include('h5.components.player.tencent', ['video' => $video])
                    @else
                        @include('h5.components.player.huawei', ['video' => $video, 'progress' => $progress[search_2DArray_key($progress, 'video_id', $video['id'])] ?? ['progress'=>0]])
                    @endif
            @else
                <div style="margin-top: 60px;">
                    <a href="{{ route('member.course.buy', [$course['id']]) }}"
                       class="btn btn-primary mt-1" style="margin-bottom: 20%;">订阅课程</a>
                </div>
            @endif
        @else
            <div style="margin-top: 60px;">
                <a class="btn btn-primary" href="{{route('login')}}" style="margin-bottom: 20%;">登录</a>
            </div>
        @endif
    </div>
    <div class="container-fluid float-left py-4 mb-3 bg-fff">
        <div class="row">
            <div class="col-12">
                <div class="video-title">
                    {{$video['title']}}
                </div>
            </div>
        </div>
    </div>

    <div class="page-chapter mb-5" style="display: block;">
        @if($chapters)
            @foreach($chapters as $chapter)
                <div class="chapter-title"><span>{{$chapter['title']}}</span></div>
                <div class="chapter-list-box">
                    @foreach($videos[$chapter['id']] ?? [] as $videoItem)
                        <a href="{{route('video.show', [$videoItem['course_id'], $videoItem['id'], $videoItem['slug']])}}"
                           class="chapter-list-item {{$video['id'] === $videoItem['id'] ? 'active' : ''}}"><span>{{$videoItem['title']}}</span></a>
                    @endforeach
                </div>
            @endforeach
        @else
            <div class="chapter-list-box">
                @foreach($videos[0] ?? [] as $videoItem)
                    <a href="{{route('video.show', [$videoItem['course_id'], $videoItem['id'], $videoItem['slug']])}}"
                       class="chapter-list-item {{$video['id'] === $videoItem['id'] ? 'active' : ''}}"><span>{{$videoItem['title']}}</span>
                        <span class="video-duration float-right" style="margin-right: 10px;">{{duration_humans($videoItem['duration'])}}</span>
                        @if($isBuy || $videoItem['charge'] === 0)
                            <span class="video-duration float-right"style="margin-right: 10px;">{{$progressData = progress_humans($progress, $videoItem['id'], $videoItem['duration'])}}</span>
                        @endif
                    </a>
                @endforeach
            </div>
        @endif
    </div>


    <div class="comment-box">
        <hr>
        <h5 class="comment-title middle mb-3 ml-2 font-bold">
            视频评论
        </h5>
        <div class="comment-input-box">
            @if(\Illuminate\Support\Facades\Auth::check())
                <textarea name="content" placeholder="请输入评论内容" class="form-control" rows="3"></textarea>
                <button type="button" data-url="{{route('ajax.video.comment', [$video['id']])}}"
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
                    <img src="{{$commentUsers[$commentItem['user_id']]['avatar']}}" width="70"
                         height="70">
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
    <script src="{{asset('frontend/js/frontend.js')}}">
    </script>
    @include("h5.components.recom_courses")

@endsection