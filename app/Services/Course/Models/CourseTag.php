<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Course\Models\CourseTag
 *
 * @property int $id
 * @property string $name 标签名
 * @property int $is_show 是否显示,1显示,0不显示
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag show()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTag whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseTag extends Model
{
    protected $table = 'course_tags';

    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = 0;

    protected $fillable = [
         'name', 'is_show',
    ];

    /**
     * @param $query Model
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->whereIsShow(self::IS_SHOW_YES);
    }


}
