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
 * App\Services\Other\Models\IndexBanner
 *
 * @property int $id
 * @property string $name banner名称
 * @property int $sort 升序
 * @property string $course_ids 课程id,英文逗号分隔
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereCourseIds($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\IndexBanner whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class IndexBanner extends Model
{
    protected $table = 'index_banners';

    protected $fillable = [
        'name', 'sort', 'course_ids',
    ];
}
