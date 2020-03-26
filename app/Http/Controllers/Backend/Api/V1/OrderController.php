<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Http\Controllers\Backend\Api\V1;

use App\Models\Order;
use App\Services\Course\Models\Course;
use App\Services\Member\Models\Role;
use App\Services\Member\Models\User;
use App\Services\Member\Models\UserCourse;
use App\Services\Order\Models\OrderGoods;
use Illuminate\Http\Request;
use App\Events\PaymentSuccessEvent;
use Illuminate\Support\Carbon;

class OrderController extends BaseController
{
    public function index(Request $request)
    {
        $keywords = $request->input('keywords', '');
        $status = $request->input('status', null);
        $orders = Order::with(['user', 'goods'])
            ->status($status)
            ->keywords($keywords)
            ->latest()
            ->paginate($request->input('page_size', 12));

        return $this->successData($orders);
    }

    public function finishOrder($id)
    {
        $order = Order::findOrFail($id);
        $order->update(['status'=>9]);
        $orderGood = OrderGoods::where('oid',$id)->first();
        switch ($orderGood->goods_type){
            case "COURSE":
                UserCourse::create(['user_id'=>$orderGood->user_id, 'course_id'=>$orderGood->goods_id, 'created_at'=>Carbon::now(),'charge'=>$orderGood->charge]);
                Course::query()->where('id',$orderGood->goods_id)->increment('user_count');
                break;
            case "ROLE":
                $role = Role::query()->where('id',$orderGood->goods_id)->first();
                User::query()->where('id',$orderGood->user_id)->update(['role_id'=>$orderGood->goods_id,'role_expired_at'=>Carbon::now()->addDays($role->expire_days)]);
                break;
            default:
                return $this->error();
        }
        event(new PaymentSuccessEvent($order->toArray()));
        return $this->success();
    }
}
