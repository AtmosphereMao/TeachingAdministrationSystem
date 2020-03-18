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

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Course\Models\CourseComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property string $original_content 原始内容
 * @property string $render_content 渲染后的内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Services\Course\Models\Course $course
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereOriginalContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereRenderContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseComment whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseComment withoutTrashed()
 * @mixin \Eloquent
 */
class CourseComment extends Base
{
    use SoftDeletes;

    protected $table = 'course_comments';

    protected $fillable = [
        'user_id', 'course_id', 'original_content', 'render_content',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }
}
