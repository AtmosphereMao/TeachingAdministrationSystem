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
 * App\Services\Member\Models\UserInviteBalanceWithdrawOrder
 *
 * @property int $id
 * @property int $user_id
 * @property int $total 提现金额,单位：元
 * @property int $before_balance 提现前账户余额
 * @property int $status 状态,0已提交,1提现成功,2拒绝
 * @property string $channel 提现渠道
 * @property string $channel_name 渠道姓名
 * @property string $channel_account 渠道账号
 * @property string $channel_address 渠道地址
 * @property string|null $remark 备注
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read mixed $status_text
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereBeforeBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereChannel($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereChannelAccount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereChannelAddress($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereChannelName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereRemark($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereStatus($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereTotal($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder withoutTrashed()
 * @mixin \Eloquent
 */
class UserInviteBalanceWithdrawOrder extends Model
{
    use SoftDeletes;

    const STATUS_DEFAULT = 0;
    const STATUS_SUCCESS = 1;
    const STATUS_FAILURE = 2;

    const STATUS_TEXT_MAP = [
        self::STATUS_DEFAULT => '已提交',
        self::STATUS_SUCCESS => '成功',
        self::STATUS_FAILURE => '失败',
    ];

    protected $table = 'user_ib_withdraw_orders';

    protected $fillable = [
        'user_id', 'total', 'before_balance', 'status',
        'channel', 'channel_name', 'channel_account', 'channel_address',
        'remark',
    ];

    protected $appends = [
        'status_text',
    ];

    public function getStatusTextAttribute()
    {
        return self::STATUS_TEXT_MAP[$this->status] ?? '';
    }
}
