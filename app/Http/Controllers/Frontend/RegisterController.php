<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Frontend;

use App\Services\Member\Models\User;
use App\Http\Controllers\BaseController;
use App\Services\Member\Services\UserService;
use App\Http\Requests\Frontend\RegisterPasswordRequest;
use App\Services\Member\Interfaces\UserServiceInterface;
use function Couchbase\defaultDecoder;

class RegisterController extends BaseController
{

    /**
     * @var UserService
     */
    protected $userService;

    public function __construct(UserServiceInterface $userService)
    {
        $this->userService = $userService;
        $this->middleware('guest');
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function showRegisterPage()
    {
        return v('frontend.auth.register');
    }

    /**
     * @param RegisterPasswordRequest $request
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function passwordRegisterHandler(RegisterPasswordRequest $request)
    {
        [
            'email' => $email,
            'password' => $password,
            'nick_name' => $nickname,
        ] = $request->filldata();
        $user = $this->userService->findNickname($nickname);
        if ($user) {
            flash(__('nick_name.unique'));
            return back();
        }
        $user = $this->userService->findEmail($email);
        if ($user) {
            flash(__('email.unique'));
            return back();
        }

        $user = $this->userService->createWithMobile($email, $password, $nickname);
        //发送邮件
        \Mail::raw(
            '请在'.$user['activity_expire'].'前,点击链接激活您的账号'.route('user.activity',['token'=>$user['activity_token']])
            ,function($message) use($user){
            $message->from(env('MAIL_USERNAME'),env('APP_NAME'))
                ->subject('注册激活邮件')
                ->to($user['email']);
        });

        flash(__('register success noactivity'), 'success');
        return redirect(route('login'));
    }
    public function activity($token){
        $user = User::where(['activity_token'=>$token])->first();
        $res = false;
        if($user && strtotime($user->activity_expire)>time())
        {
            $user->is_activity = 1;
            $res = $user->save();
        }
        return view('frontend.auth.activityres',['res'=>$res]);
    }

}
