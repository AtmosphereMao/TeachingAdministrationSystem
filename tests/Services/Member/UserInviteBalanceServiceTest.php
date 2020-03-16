<?php


namespace Tests\Services\Member;

use App\Services\Member\Interfaces\UserInviteBalanceServiceInterface;
use App\Services\Member\Models\User;
use App\Services\Member\Models\UserInviteBalanceRecord;
use App\Services\Member\Models\UserInviteBalanceWithdrawOrder;
use App\Services\Member\Services\UserInviteBalanceService;
use App\Services\Order\Models\Order;
use Illuminate\Support\Facades\Auth;
use Tests\TestCase;

class UserInviteBalanceServiceTest extends TestCase
{

    /**
     * @var UserInviteBalanceService
     */
    protected $service;

    public function setUp()
    {
        parent::setUp();
        $this->service = $this->app->make(UserInviteBalanceServiceInterface::class);
    }

    public function test_createInvite()
    {
        $user = factory(User::class)->create();
        $this->service->createInvite($user->id, 10);

        $r = UserInviteBalanceRecord::whereUserId($user->id)->first();
        $this->assertNotEmpty($r);
        $this->assertEquals(10, $r->total);
        $this->assertEquals(UserInviteBalanceRecord::TYPE_DEFAULT, $r->type);
    }

    public function test_createOrderDraw()
    {
        $user = factory(User::class)->create();
        $order = factory(Order::class)->create([
            'user_id' => $user->id,
            'charge' => 100,
        ]);
        $this->service->createOrderDraw($user->id, 10, $order->toArray());

        $r = UserInviteBalanceRecord::whereUserId($user->id)->first();
        $this->assertNotEmpty($r);
        $this->assertEquals(10, $r->total);
        $this->assertEquals(UserInviteBalanceRecord::TYPE_ORDER_DRAW, $r->type);
    }

    /**
     * @expectedException \App\Exceptions\ServiceException
     */
    public function test_createCurrentUserWithdraw()
    {
        $user = factory(User::class)->create([
            'invite_balance' => 0,
        ]);
        Auth::login($user);
        $channel = [
            'name' => '支付宝',
            'username' => 'admin',
            'account' => 'admin',
            'address' => '地址',
        ];
        $this->service->createCurrentUserWithdraw(10, $channel);
    }

    public function test_createCurrentUserWithdraw_with_sufficient()
    {
        $user = factory(User::class)->create([
            'invite_balance' => 100,
        ]);
        Auth::login($user);
        $channel = [
            'name' => '支付宝',
            'username' => 'admin',
            'account' => 'admin',
            'address' => '地址',
        ];
        $this->service->createCurrentUserWithdraw(10, $channel);

        $user->refresh();
        $this->assertEquals(90, $user->invite_balance);
        $order = UserInviteBalanceWithdrawOrder::whereUserId($user->id)->first();
        $this->assertNotEmpty($order);
        $this->assertEquals(10, $order->total);
        $this->assertEquals(100, $order->before_balance);
    }

}