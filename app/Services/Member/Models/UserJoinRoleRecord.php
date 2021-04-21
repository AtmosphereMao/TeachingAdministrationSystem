<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Member\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Member\Models\UserJoinRoleRecord
 *
 * @property int $id
 * @property int $user_id
 * @property int $role_id
 * @property int $charge
 * @property string|null $started_at
 * @property string|null $expired_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property-read \App\Services\Member\Models\Role $role
 * @property-read \App\User $user
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereExpiredAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereRoleId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereStartedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserJoinRoleRecord whereUserId($value)
 * @mixin \Eloquent
 */
class UserJoinRoleRecord extends Model
{
    protected $table = 'user_join_role_records';

    protected $fillable = [
        'user_id', 'role_id', 'charge', 'started_at', 'expired_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id');
    }

    public function role()
    {
        return $this->belongsTo(Role::class, 'role_id');
    }
}
