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

use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * App\Services\Member\Models\User
 *
 * @property int $id
 * @property \Illuminate\Config\Repository|mixed $avatar
 * @property string $nick_name
 * @property string $email
 * @property string $password
 * @property int $credit1
 * @property int $credit2
 * @property int $credit3
 * @property int $is_active 1:active,-1:unactive
 * @property int $is_lock 1:lock,-1:unlock
 * @property string|null $remember_token
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $role_id 角色ID
 * @property string|null $role_expired_at 过期时间
 * @property int $invite_balance 邀请奖励余额
 * @property int $invite_user_id 邀请人id
 * @property string|null $invite_user_expired_at 邀请过期时间
 * @property int $is_password_set 密码是否配置,0否,1是
 * @property int $is_set_nickname 配置昵称,1是,0否
 * @property string $activity_token 激活验证token
 * @property string $activity_expire 激活过期时间
 * @property int $is_activity 是否激活1是，0否
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Member\Models\UserInviteBalanceWithdrawOrder[] $inviteBalanceWithdrawOrders
 * @property-read int|null $invite_balance_withdraw_orders_count
 * @property-read \Illuminate\Notifications\DatabaseNotificationCollection|\Illuminate\Notifications\DatabaseNotification[] $notifications
 * @property-read int|null $notifications_count
 * @property-read \App\Services\Member\Models\Role $role
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereActivityExpire($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereActivityToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereAvatar($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereCredit1($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereCredit2($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereCredit3($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereEmail($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereInviteBalance($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereInviteUserExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereInviteUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereIsActive($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereIsActivity($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereIsLock($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereIsPasswordSet($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereIsSetNickname($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereNickName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User wherePassword($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereRememberToken($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereRoleExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\User whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class User extends Authenticatable implements JWTSubject
{
    use Notifiable;

    const ACTIVE_YES = 1;
    const ACTIVE_NO = -1;

    const LOCK_YES = 1;
    const LOCK_NO = -1;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'avatar', 'nick_name', 'password', 'email',
        'is_lock', 'is_active', 'role_id', 'role_expired_at',
        'invite_user_id', 'invite_balance', 'invite_user_expired_at',
        'is_password_set', 'is_set_nickname',
        'activity_token','activity_expire',
    ];

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * 所属角色.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }

    /**
     * 头像修饰器.
     *
     * @return \Illuminate\Config\Repository|mixed
     */
    public function getAvatarAttribute($avatar)
    {
        return $avatar ?: url(config('meedu.member.default_avatar'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function inviteBalanceWithdrawOrders()
    {
        return $this->hasMany(UserInviteBalanceWithdrawOrder::class, 'user_id');
    }
}
