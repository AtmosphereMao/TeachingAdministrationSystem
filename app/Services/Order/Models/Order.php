<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Order\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;
use App\Services\Base\Services\ConfigService;

class Order extends Model
{
    const STATUS_UNPAY = 1;
    const STATUS_PAYING = 5;
    const STATUS_PAID = 9;
    const STATUS_CANCELED = 7;

    const STATUS_TEXT = [
        self::STATUS_UNPAY => '未支付',
        self::STATUS_PAYING => '支付中',
        self::STATUS_PAID => '已支付',
        self::STATUS_CANCELED => '已取消',
    ];

    protected $table = 'orders';

    protected $fillable = [
        'user_id', 'charge', 'status', 'order_id', 'payment',
        'payment_method',
    ];

    protected $appends = [
        'status_text', 'payment_text', 'continue_pay',
    ];

    public function getStatusTextAttribute()
    {
        return $this->statusText();
    }

    public function getPaymentTextAttribute()
    {
        return $this->getPaymentText();
    }

    public function getContinuePayAttribute()
    {
        return in_array($this->status, [self::STATUS_UNPAY, self::STATUS_PAYING]);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function goods()
    {
        return $this->hasMany(OrderGoods::class, 'oid');
    }

    /**
     * 订单状态文本.
     *
     * @return string
     */
    public function statusText(): string
    {
        return self::STATUS_TEXT[$this->status] ?? '';
    }

    /**
     * @param $query
     * @param $status
     *
     * @return mixed
     */
    public function scopeStatus($query, $status)
    {
        if (!$status) {
            return $query;
        }

        return $query->where('status', $status);
    }

    /**
     * @param $query
     * @param $keywords
     *
     * @return mixed
     */
    public function scopeKeywords($query, $keywords)
    {
        if (!$keywords) {
            return $query;
        }
        $memberIds = User::where('nick_name', 'like', "%{$keywords}%")
            ->orWhere('mobile', 'like', "%{$keywords}%")
            ->select('id')
            ->pluck('id');

        return $query->whereIn('user_id', $memberIds);
    }

    /**
     * 获取今日已支付订单数量.
     *
     * @return mixed
     */
    public static function todayPaidNum()
    {
        return self::where('created_at', '>=', date('Y-m-d'))->status(self::STATUS_PAID)->count();
    }

    /**
     * 获取今日已支付总金额.
     *
     * @return mixed
     */
    public static function todayPaidSum()
    {
        return self::where('created_at', '>=', date('Y-m-d'))->status(self::STATUS_PAID)->sum('charge');
    }

    /**
     * 获取支付网关名.
     *
     * @return string
     */
    public function getPaymentText()
    {
        /**
         * @var ConfigService
         */
        $configService = app()->make(ConfigService::class);
        $payments = collect($configService->getPayments());

        return $payments[$this->payment]['name'] ?? '';
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function paidRecords()
    {
        return $this->hasMany(OrderPaidRecord::class, 'order_id');
    }
}
