<div class="container p-5">
    <div class="row border-top pt-2">
        <div class="recom-courses-title">
            <span>推荐课程</span>
        </div>
        <div class="course-list-box">
            @foreach($gRecCourses as $index => $courseItem)
                @if($index == 4)
                    @break
                @endif
                <a href="{{route('course.show', [$courseItem['id'], $courseItem['slug']])}}"
                   class="course-list-item {{(($index + 1) % 4 == 0) ? 'last' : ''}}">
                    <div class="course-thumb">
                        <img src="{{$courseItem['thumb']}}" width="100%" height="100%" alt="{{$courseItem['title']}}">
                    </div>
                    <div class="course-title">
                        {{$courseItem['title']}}
                    </div>
                    <div class="course-category">
                        <span class="video-count-label">课时：{{$courseItem['videos_count']}}节</span>
                        <span class="category-label">{{$courseItem['category']['name']}}</span>
                    </div>
                </a>
            @endforeach
        </div>
    </div>
</div>