@extends('layouts.h5')

@section('content')

    <div class="container-fluid bg-fff mb-5">
        <div class="row">
            <div class="col-12">
                <h3 class="my-3 mt-4 mb-4 ml-2">全部课程</h3>
                <div class="course-menu-box">
                    <div class="menu-item {{!$scene ? 'active' : ''}} btn btn-outline-dark m-1">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => ''])}}" class="{{!$scene ? 'text-white' : 'text-black-50'}}">所有课程</a>
                    </div>
                    <div class="menu-item {{$scene == 'recom' ? 'active' : ''}} btn btn-outline-dark m-1">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => 'recom'])}}" class="{{$scene == 'recom' ? 'text-white' : 'text-black-50'}}">推荐课程</a>
                    </div>
                    <div class="menu-item {{$scene == 'sub' ? 'active' : ''}} btn btn-outline-dark m-1">
                        <a href="{{route('courses')}}?{{$queryParams(['scene' => 'sub'])}}" class="{{$scene == 'sub' ? 'text-white' : 'text-black-50'}}">订阅最多</a>
                    </div>
                </div>

                <div class="category-box">
                    <a href="{{route('courses')}}?{{$queryParams(['category_id' => 0])}}"
                       class="category-box-item {{!$categoryId ? 'active' : ''}} btn btn-outline-info m-1">不限</a>
                    @foreach($courseCategories as $category)
                        <a href="{{route('courses')}}?{{$queryParams(['category_id' => $category['id']])}}"
                           class="category-box-item {{$categoryId == $category['id'] ? 'active' : ''}} btn btn-outline-info m-1">{{$category['name']}}</a>
                    @endforeach
                </div>
                <div class="category-box">
                    <a href="{{route('courses')}}?{{$queryParams(['tag_id' => [0]])}}"
                       class="category-box-item {{in_array(0,$tagId) ? 'active' : ''}} btn btn-outline-info m-1">不限</a>
                    @foreach($courseTags as $tag)
                        {{--@if(in_array($tag['id'],$tagId))--}}
                        <a href="{{route('courses')}}?{{$queryParams(['tag_id' => [$tag['id']]])}}"
                           class="category-box-item {{in_array($tag['id'],$tagId) ? 'active' : ''}} btn btn-outline-info m-1">{{$tag['name']}}</a>
                        {{--@endif--}}
                    @endforeach
                </div>
            </div>
            <div class="col-12 mt-3">
                <div class="course-list-box">
                    @foreach($courses as $course)
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

    <div class="container-fluid">
        <div class="row">
            <div class="col-12">
                {!! str_replace('pagination', 'pagination justify-content-center', $courses->render()) !!}
            </div>
        </div>
    </div>

    @include('h5.components.navbar')

@endsection