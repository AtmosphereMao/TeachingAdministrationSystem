<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Order\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Order\Models\OrderPaidRecord
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property int $order_id 订单id
 * @property int $paid_total 支付金额
 * @property int $paid_type 支付类型，0默认支付,1优惠码,2余额支付
 * @property int $paid_type_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Services\Order\Models\Order $order
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\OrderPaidRecord onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord wherePaidTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord wherePaidType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord wherePaidTypeId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderPaidRecord whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\OrderPaidRecord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\OrderPaidRecord withoutTrashed()
 * @mixin \Eloquent
 */
class OrderPaidRecord extends Model
{
    use SoftDeletes;

    const PAID_TYPE_DEFAULT = 0;
    const PAID_TYPE_PROMO_CODE = 1;
    const PAID_TYPE_INVITE_BALANCE = 2;

    const PAID_TYPE_TEXT = [
        self::PAID_TYPE_DEFAULT => '直接支付',
        self::PAID_TYPE_INVITE_BALANCE => '邀请余额支付',
        self::PAID_TYPE_PROMO_CODE => '优惠码支付',
    ];

    protected $table = 'order_paid_records';

    protected $fillable = [
        'user_id', 'order_id', 'paid_total', 'paid_type', 'paid_type_id',
    ];

    public function order()
    {
        return $this->belongsTo(Order::class, 'order_id');
    }
}
