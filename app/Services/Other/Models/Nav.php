<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Other\Models\Nav
 *
 * @property int $id
 * @property int $sort
 * @property string $name 链接名
 * @property string $url 链接地址
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Nav whereUrl($value)
 * @mixin \Eloquent
 */
class Nav extends Model
{
    protected $table = 'navs';

    protected $fillable = [
        'sort', 'name', 'url',
    ];
}
