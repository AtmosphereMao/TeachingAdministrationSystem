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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Order\Models\PromoCode
 *
 * @property int $id
 * @property int $user_id 用户id
 * @property string $code 优惠码
 * @property string|null $expired_at 过期时间
 * @property int $invite_user_reward 邀请用户奖励
 * @property int $invited_user_reward 邀请用户奖励
 * @property int $use_times 可使用次数，0表示不限制
 * @property int $used_times 已使用次数
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\PromoCode onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereCode($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereInviteUserReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereInvitedUserReward($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereUseTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereUsedTimes($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Order\Models\PromoCode whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\PromoCode withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Order\Models\PromoCode withoutTrashed()
 * @mixin \Eloquent
 */
class PromoCode extends Model
{
    use SoftDeletes;

    protected $table = 'promo_codes';

    protected $fillable = [
        'user_id', 'code', 'expired_at',
        'invite_user_reward', 'invited_user_reward',
        'use_times', 'used_times',
    ];
}
