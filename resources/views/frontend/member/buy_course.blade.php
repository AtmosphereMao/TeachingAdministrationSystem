@extends('layouts.member')

@section('member')

    <div class="container">
        <div class="row">
            <div class="col-12">
                <div class="course-menu-box">
                    <div class="menu-item {{!$scene ? 'active' : ''}}">
                        <a href="{{route('member.courses')}}?{{$queryParams(['scene' => ''])}}">订阅课程</a>
                    </div>
                    <div class="menu-item {{$scene === 'history' ? 'active' : ''}}">
                        <a href="{{route('member.courses')}}?{{$queryParams(['scene' => 'history'])}}">历史学习</a>
                    </div>
                    <div class="menu-item {{$scene === 'like' ? 'active' : ''}}">
                        <a href="{{route('member.courses')}}?{{$queryParams(['scene' => 'like'])}}">我的收藏</a>
                    </div>
                </div>
            </div>

            <div class="col-12">
                <div class="my-courses course-list-box">
                    @forelse($records as $index => $record)
                        @if(!($course = $courses[$record['course_id']] ?? []))
                            @continue
                        @endif
                        <a href="{{route('course.show', [$course['id'], $course['slug']])}}"
                           class="course-list-item {{(($index + 1) % 4 == 0) ? 'last' : ''}}">
                            <div class="course-thumb">
                                <img src="{{$course['thumb']}}" width="280" height="210" alt="{{$course['title']}}">
                            </div>
                            <div class="course-title">
                                {{$course['title']}}
                            </div>
                            <div class="course-category">
                                <span class="video-count-label">课时：{{$course['videos_count']}}节</span>
                                <span class="category-label">{{$course['category']['name']}}</span>
                            </div>
                        </a>
                    @empty
                        @include('frontend.components.none')
                    @endforelse
                </div>
            </div>

            @if($records->total() > $records->perPage())
                <div class="col-12">
                    {!! str_replace('pagination', 'pagination justify-content-center', $records->render()) !!}
                </div>
            @endif
        </div>
    </div>

@endsection