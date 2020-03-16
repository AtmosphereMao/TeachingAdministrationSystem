<?php


namespace Tests\Services\Course;

use App\Services\Course\Interfaces\VideoServiceInterface;
use App\Services\Course\Models\Course;
use App\Services\Course\Models\CourseChapter;
use App\Services\Course\Models\Video;
use App\Services\Course\Services\VideoService;
use Carbon\Carbon;
use Tests\TestCase;

class VideoServiceTest extends TestCase
{

    /**
     * @var VideoService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(VideoServiceInterface::class);
    }

    public function test_courseVideos_with_no_chapters()
    {
        $videoTotal = random_int(5, 10);
        $course = factory(Course::class)->create();
        factory(Video::class, $videoTotal)->create([
            'course_id' => $course->id,
            'published_at' => Carbon::now()->subDays(1),
            'is_show' => Video::IS_SHOW_YES,
            'chapter_id' => 0,
        ]);

        $list = $this->service->courseVideos($course['id']);

        $this->assertEquals($videoTotal, count($list[0]));
    }

    public function test_courseVideos_with_no_chapters_with_cache()
    {
        config(['meedu.system.cache.status' => 1]);
        $course = factory(Course::class)->create();
        factory(Video::class, 10)->create([
            'course_id' => $course->id,
            'published_at' => Carbon::now()->subDays(1),
            'is_show' => Video::IS_SHOW_YES,
            'chapter_id' => 0,
        ]);

        $list = $this->service->courseVideos($course['id']);
        $this->assertEquals(10, count($list[0]));

        factory(Video::class, 2)->create([
            'course_id' => $course->id,
            'published_at' => Carbon::now()->subDays(1),
            'is_show' => Video::IS_SHOW_YES,
            'chapter_id' => 0,
        ]);
        $list = $this->service->courseVideos($course['id']);
        $this->assertEquals(10, count($list[0]));
    }

    public function test_courseVideos_with_chapters()
    {
        $total = [];
        $course = factory(Course::class)->create();
        $chapters = factory(CourseChapter::class, random_int(1, 5))->create();
        foreach ($chapters as $chapter) {
            $count = random_int(1, 5);
            factory(Video::class, $count)->create([
                'course_id' => $course->id,
                'published_at' => Carbon::now()->subDays(1),
                'is_show' => Video::IS_SHOW_YES,
                'chapter_id' => $chapter->id,
            ]);
            $total[$chapter->id] = $count;
        }

        $list = $this->service->courseVideos($course['id']);

        foreach ($chapters as $chapter) {
            $this->assertEquals($total[$chapter->id], count($list[$chapter->id]));
        }
    }

    public function test_courseVideos_with_chapters_with_cache()
    {
        config(['meedu.system.cache.status' => 1]);
        config(['meedu.system.cache.expire' => 10]);
        $total = [];
        $course = factory(Course::class)->create();
        $chapters = factory(CourseChapter::class, random_int(1, 5))->create();
        foreach ($chapters as $chapter) {
            $count = random_int(1, 5);
            factory(Video::class, $count)->create([
                'course_id' => $course->id,
                'published_at' => Carbon::now()->subDays(1),
                'is_show' => Video::IS_SHOW_YES,
                'chapter_id' => $chapter->id,
            ]);
            $total[$chapter->id] = $count;
        }

        $list = $this->service->courseVideos($course['id']);
        foreach ($chapters as $chapter) {
            $this->assertEquals($total[$chapter->id], count($list[$chapter->id]));
        }

        foreach ($chapters as $chapter) {
            $count = random_int(1, 5);
            factory(Video::class, $count)->create([
                'course_id' => $course->id,
                'published_at' => Carbon::now()->subDays(1),
                'is_show' => Video::IS_SHOW_YES,
                'chapter_id' => $chapter->id,
            ]);
            $total[$chapter->id] = $count;
        }

        $list1 = $this->service->courseVideos($course['id']);
        $this->assertEquals($list, $list1);
    }

    public function test_simplePage()
    {
        $videos = factory(Video::class, 10)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $page = $this->service->simplePage(1, 5);
        $this->assertEquals(10, $page['total']);
        $this->assertEquals(5, count($page['list']));
    }

    public function test_find()
    {
        $video = factory(Video::class)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $v = $this->service->find($video->id);
        $this->assertNotEmpty($v);
        $this->assertEquals($video->title, $v['title']);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_find_with_no_published()
    {
        $video = factory(Video::class)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->addDays(1),
        ]);
        $this->service->find($video->id);
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_find_with_no_show()
    {
        $video = factory(Video::class)->create([
            'is_show' => Video::IS_SHOW_NO,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $this->service->find($video->id);
    }

    public function test_getLatestVideos()
    {
        factory(Video::class, 5)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $videos = $this->service->getLatestVideos(3);
        $this->assertNotEmpty(3, count($videos));
    }

    public function test_getLatestVideos_with_cache()
    {
        config(['meedu.system.cache.status' => 1]);
        factory(Video::class, 5)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $videos = $this->service->getLatestVideos(10);
        $this->assertNotEmpty(5, count($videos));

        factory(Video::class, 2)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $videos = $this->service->getLatestVideos(10);
        $this->assertNotEmpty(5, count($videos));
    }

    public function test_getList()
    {
        $videos = factory(Video::class, 5)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);
        $video1 = $videos[0];
        $video2 = $videos[1];
        $list = $this->service->getList([$video1->id, $video2->id]);
        $list = array_column($list, null, 'id');
        $this->assertNotEmpty($list);
        $this->assertTrue(isset($list[$video1->id]));
        $this->assertTrue(isset($list[$video2->id]));
    }

    public function test_viewNumInc()
    {
        config(['meedu.system.cache.status' => 0]);
        $video = factory(Video::class)->create(['view_num' => 1]);
        $this->service->viewNumInc($video['id']);
        $video->refresh();
        $this->assertEquals(2, $video->view_num);

        config(['meedu.system.cache.status' => 1]);
        $this->service->viewNumInc($video['id']);
        $video->refresh();
        $this->assertEquals(2, $video->view_num);

        $this->service->viewNumInc($video['id']);
        $this->service->viewNumInc($video['id']);
        $this->service->viewNumInc($video['id']);
        $this->service->viewNumInc($video['id']);
        $this->service->viewNumInc($video['id']);
        $video->refresh();
        $this->assertEquals(8, $video->view_num);
    }

}