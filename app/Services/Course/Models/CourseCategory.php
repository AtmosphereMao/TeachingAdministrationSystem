<?php

/*
 * This file is part of the Qsnh/meedu.
 *
 * (c) XiaoTeng <616896861@qq.com>
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Course\Models\CourseCategory
 *
 * @property int $id
 * @property string $name 分类名
 * @property int $parent_id 父id
 * @property string $parent_chain 父链
 * @property int $is_show 是否显示,1显示,0不显示
 * @property int $sort 升序
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory show()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory sort()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereParentChain($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereParentId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseCategory whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseCategory extends Model
{
    protected $table = 'course_categories';

    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = 0;

    protected $fillable = [
        'sort', 'name', 'parent_id', 'parent_chain',
        'is_show',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->whereIsShow(self::IS_SHOW_YES);
    }

    /**
     * @param $query
     * @return mixed
     */
    public function scopeSort($query)
    {
        return $query->orderBy('sort');
    }
}
