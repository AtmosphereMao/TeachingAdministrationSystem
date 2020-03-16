<?php

namespace Tests\Feature\Page;

use App\Services\Member\Models\User;
use Illuminate\Support\Facades\Hash;
use Tests\TestCase;

class MemberPasswordChangeTest extends TestCase
{

    public function test_member_password_change()
    {
        $user = factory(User::class)->create();
        $this->actingAs($user)
            ->visit(route('member.password_reset'))
            ->assertResponseStatus(200);
    }

    public function test_member_password_change_action()
    {
        $password = '123456';
        $user = factory(User::class)->create([
            'password' => Hash::make($password),
        ]);
        $newPassword = '123456789';
        $this->actingAs($user)
            ->visit(route('member.password_reset'))
            ->type($newPassword, 'new_password')
            ->type($newPassword, 'new_password_confirmation')
            ->type($password, 'old_password')
            ->press('修改密码')
            ->assertResponseStatus(200);

        // 断言密码修改成功
        $user->refresh();
        $this->assertTrue(Hash::check($newPassword, $user->password));
    }

}
