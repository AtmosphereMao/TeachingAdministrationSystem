<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Member\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Member\Models\UserInviteBalanceRecord
 *
 * @property int $id
 * @property int $user_id
 * @property int $type 0邀请奖励
 * @property int $total
 * @property string $desc
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceRecord onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereType($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceRecord whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceRecord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceRecord withoutTrashed()
 * @mixin \Eloquent
 */
class UserInviteBalanceRecord extends Model
{
    use SoftDeletes;

    const TYPE_DEFAULT = 0;
    const TYPE_ORDER_DRAW = 1;
    const TYPE_ORDER_WITHDRAW = 2;
    const TYPE_ORDER_WITHDRAW_BACK = 3;

    const TYPE_TEXT = [
        self::TYPE_DEFAULT => '邀请奖励',
        self::TYPE_ORDER_DRAW => '订单抽成',
        self::TYPE_ORDER_WITHDRAW => '提现',
        self::TYPE_ORDER_WITHDRAW_BACK => '提现退回',
    ];

    protected $table = 'user_invite_balance_records';

    protected $fillable = [
        'user_id', 'type', 'total', 'desc',
    ];
}
