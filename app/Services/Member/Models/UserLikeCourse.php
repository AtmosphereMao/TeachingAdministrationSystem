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

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Member\Models\UserLikeCourse
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserLikeCourse onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserLikeCourse whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserLikeCourse withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Member\Models\UserLikeCourse withoutTrashed()
 * @mixin \Eloquent
 */
class UserLikeCourse extends Model
{
    use SoftDeletes;

    protected $table = 'user_like_courses';

    protected $fillable = [
        'user_id', 'course_id',
    ];
}
