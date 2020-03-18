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

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Order\Models\OrderGoods
 *
 * @property int $id
 * @property int $oid 订单id
 * @property int $user_id
 * @property string $order_id 订单编号
 * @property int $goods_id 商品ID
 * @property string $goods_type 商品类型标识符
 * @property int $num 商品数量
 * @property int $charge 商品价格
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read mixed $goods_text
 * @property-read \App\Services\Order\Models\Order $order
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereGoodsId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereGoodsType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereNum($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereOid($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereOrderId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\OrderGoods whereUserId($value)
 * @mixin \Eloquent
 */
class OrderGoods extends Model
{
    const GOODS_TYPE_COURSE = 'COURSE';
    const GOODS_TYPE_VIDEO = 'VIDEO';
    const GOODS_TYPE_ROLE = 'ROLE';
    const GOODS_TYPE_BOOK = 'BOOK';

    protected $table = 'order_goods';

    protected $fillable = [
        'user_id', 'goods_id', 'goods_type', 'oid',
        'num', 'charge',
        // todo 即将废弃
        'order_id',
    ];

    protected $appends = [
        'goods_text',
    ];

    public function getGoodsTextAttribute()
    {
        return __($this->goods_type);
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function order()
    {
        return $this->belongsTo(Order::class, 'oid');
    }
}
