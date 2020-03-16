<?php


namespace Tests\Services\Course;


use App\Services\Course\Interfaces\VideoCommentServiceInterface;
use App\Services\Course\Models\Video;
use App\Services\Course\Models\VideoComment;
use App\Services\Course\Services\VideoCommentService;
use App\Services\Member\Interfaces\NotificationServiceInterface;
use App\Services\Member\Models\User;
use App\Services\Member\Services\NotificationService;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class VideoCommentServiceTest extends TestCase
{

    /**
     * @var VideoCommentService
     */
    protected $service;

    /**
     * @var NotificationService
     */
    protected $notificationService;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(VideoCommentServiceInterface::class);
        $this->notificationService = $this->app->make(NotificationServiceInterface::class);
    }

    public function test_create()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $video = factory(Video::class)->create();

        $comment = $this->service->create($video->id, '我是评价的内容');

        $this->assertEquals('我是评价的内容', $comment['original_content']);
        $this->assertEquals($user->id, $comment['user_id']);
    }

    public function test_create_with_at()
    {
        $user = factory(User::class)->create();
        $user1 = factory(User::class)->create();
        Auth::login($user);
        $video = factory(Video::class)->create([
            'is_show' => Video::IS_SHOW_YES,
            'published_at' => Carbon::now()->subDays(1),
        ]);

        $content = '我是评价@' . $user1->nick_name . ' 的内容';
        $comment = $this->service->create($video->id, $content);

        $this->assertEquals($content, $comment['original_content']);
        $this->assertEquals($user->id, $comment['user_id']);

        $this->assertEquals(1, $this->notificationService->getUserUnreadCount($user1->id));
    }

    public function test_courseComments()
    {
        $video = factory(Video::class)->create();
        $comments = factory(VideoComment::class, 10)->create([
            'video_id' => $video,
            'user_id' => 1,
        ]);

        $list = $this->service->videoComments($video->id);
        $this->assertEquals($comments->count(), count($list));
    }

    /**
     * @expectedException Illuminate\Database\Eloquent\ModelNotFoundException
     */
    public function test_find_with_not_exists()
    {
        $this->service->find(12);
    }

    public function test_find()
    {
        $comment = factory(VideoComment::class)->create();
        $c = $this->service->find($comment->id);
        $this->assertEquals($comment->original_content, $c['original_content']);
    }

}