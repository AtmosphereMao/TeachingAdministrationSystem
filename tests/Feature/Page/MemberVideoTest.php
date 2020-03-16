<?php

namespace Tests\Feature\Page;

use App\Services\Course\Models\Video;
use App\Services\Member\Models\User;
use App\Services\Member\Models\UserVideo;
use Carbon\Carbon;
use Tests\TestCase;

class MemberVideoTest extends TestCase
{

    public function test_member_video()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->visit(route('member.course.videos'))
            ->see('暂无数据');
    }

    public function test_member_video_see_some_records()
    {
        $video = factory(Video::class)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $user = factory(User::class)->create();
        $charge = random_int(1, 100);
        UserVideo::create([
            'user_id' => $user->id,
            'video_id' => $video->id,
            'charge' => $charge,
            'created_at' => Carbon::now(),
        ]);
        $this->actingAs($user)
            ->visit(route('member.course.videos'))
            ->see($video->title)
            ->see($charge);
    }

}
