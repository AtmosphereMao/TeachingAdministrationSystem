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

/**
 * App\Services\Order\Models\Order
 *
 * @property int $id
 * @property int $user_id
 * @property int $charge
 * @property int $status 1未处理,9已处理
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @property string $order_id 订单编号
 * @property string $payment 支付网关
 * @property string $payment_method 支付方式
 * @property-read mixed $continue_pay
 * @property-read mixed $payment_text
 * @property-read mixed $status_text
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Order\Models\OrderGoods[] $goods
 * @property-read int|null $goods_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Order\Models\OrderPaidRecord[] $paidRecords
 * @property-read int|null $paid_records_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order keywords($keywords)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order status($status)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order wherePayment($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order wherePaymentMethod($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\Order whereUserId($value)
 * @mixin \Eloquent
 */
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
     * @param $query Model
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
     * @param $query Model
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
