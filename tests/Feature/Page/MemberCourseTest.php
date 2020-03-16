<?php

namespace Tests\Feature\Page;

use App\Services\Course\Models\Course;
use App\Services\Member\Models\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Tests\TestCase;

class MemberCourseTest extends TestCase
{

    public function test_member_course()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->visit(route('member.courses'));
    }

    public function test_member_course_see_some_records()
    {
        $course = factory(Course::class)->create([
            'is_show' => Course::SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $user = factory(User::class)->create();
        $charge = random_int(1, 100);
        DB::table('user_course')->insert([
            'course_id' => $course->id,
            'charge' => $charge,
            'created_at' => Carbon::now(),
            'user_id' => $user->id,
        ]);
        $this->actingAs($user)
            ->visit(route('member.courses'))
            ->see($course->title);
    }

}
