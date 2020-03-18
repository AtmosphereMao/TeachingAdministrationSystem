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
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Course\Models\CourseUserRecord
 *
 * @property int $id
 * @property int $course_id
 * @property int $user_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseUserRecord onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseUserRecord whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseUserRecord withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\CourseUserRecord withoutTrashed()
 * @mixin \Eloquent
 */
class CourseUserRecord extends Model
{
    use SoftDeletes;

    protected $table = 'course_user_records';

    protected $fillable = [
        'course_id', 'user_id',
    ];
}
