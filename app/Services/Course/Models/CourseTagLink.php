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
 * App\Services\Course\Models\CourseTagLink
 *
 * @property int $id
 * @property string $tag_id 标签id
 * @property string $course_id 课程id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $deleted_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereTagId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseTagLink whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseTagLink extends Model
{
    protected $table = 'course_tags_link';


    protected $fillable = [
        'tag_id', 'course_id'
    ];

}
