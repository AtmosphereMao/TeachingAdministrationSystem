<?php


namespace Tests\Services\Member;

use App\Services\Member\Interfaces\SocialiteServiceInterface;
use App\Services\Member\Models\Socialite;
use App\Services\Member\Models\User;
use App\Services\Member\Services\SocialiteService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Str;
use Tests\TestCase;

class SocialiteServiceTest extends TestCase
{

    /**
     * @var SocialiteService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(SocialiteServiceInterface::class);
    }

    public function test_getBindUserId()
    {
        $user = factory(User::class)->create();
        $socialite = factory(Socialite::class)->create(['user_id' => $user->id]);
        $userId = $this->service->getBindUserId($socialite->app, $socialite->app_user_id);
        $this->assertEquals($user->id, $userId);
    }

    public function test_bindApp()
    {
        $user = factory(User::class)->create();
        $app = 'app1';
        $appUserId = Str::random();
        $this->service->bindApp($user->id, $app, $appUserId, []);
        $userId = $this->service->getBindUserId($app, $appUserId);
        $this->assertEquals($user->id, $userId);
    }

    /**
     * @expectedException \App\Exceptions\ServiceException
     */
    public function test_bindApp_repeat()
    {
        $user = factory(User::class)->create();
        $app = 'app1';
        $appUserId = Str::random();
        $this->service->bindApp($user->id, $app, $appUserId, []);
        $this->service->bindApp($user->id, $app, $appUserId, []);
    }

    public function test_bindAppWithNewUser()
    {
        $app = 'app1';
        $appUserId = Str::random();
        $userId = $this->service->bindAppWithNewUser($app, $appUserId, []);
        $user = User::find($userId);
        $this->assertTrue(substr($user->mobile, 0, 1) != 1);
    }

    public function test_userSocialites()
    {
        $user = factory(User::class)->create();
        factory(Socialite::class, 4)->create(['user_id' => $user->id]);
        $list = $this->service->userSocialites($user->id);
        $this->assertEquals(4, count($list));
    }

    public function test_cancelBind()
    {
        $user = factory(User::class)->create();
        Auth::login($user);
        $app = 'app1';
        $appUserId = Str::random();
        $this->service->bindApp($user->id, $app, $appUserId, []);
        $this->service->cancelBind($app);
        $this->assertEmpty(Socialite::whereUserId($user->id)->where('app', $app)->whereAppUserId($appUserId)->first());
    }

}