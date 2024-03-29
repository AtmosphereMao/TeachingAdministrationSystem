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
 * App\Services\Member\Models\Role
 *
 * @property int $id
 * @property string $name 角色名
 * @property int $charge 价格，单位：元
 * @property int $expire_days 有效期，单位：天
 * @property int $weight 权重，升序
 * @property string $description 详细描述，一行一个
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $is_show 0不显示,1显示
 * @property-read array $desc_rows
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\User[] $users
 * @property-read int|null $users_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role show()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereExpireDays($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\Role whereWeight($value)
 * @mixin \Eloquent
 */
class Role extends Model
{
    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = 0;

    protected $table = 'roles';

    protected $fillable = [
        'name', 'charge', 'expire_days', 'weight', 'description',
        'is_show',
    ];

    protected $appends = [
        'desc_rows',
    ];

    /**
     * @return array
     */
    public function getDescRowsAttribute()
    {
        return explode("\n", $this->description);
    }

    /**
     * 当前会员下的用户.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function users()
    {
        return $this->hasMany(User::class, 'user_id');
    }

    /**
     * @return array
     */
    public function descriptionRows()
    {
        return explode("\n", $this->getAttribute('description'));
    }

    /**
     * 作用域：显示.
     *
     * @param $query Model
     *
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->where('is_show', self::IS_SHOW_YES);
    }

    /**
     * @return string
     */
    public function statusText()
    {
        return $this->is_show == self::IS_SHOW_YES ? '显示' : '不显示';
    }
}
