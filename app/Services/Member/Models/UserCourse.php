<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Member\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Member\Models\UserCourse
 *
 * @property int $user_id
 * @property int $course_id
 * @property string|null $created_at
 * @property int $charge 收费
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserCourse whereUserId($value)
 * @mixin \Eloquent
 */
class UserCourse extends Model
{
    protected $table = 'user_course';

    protected $fillable = [
        'course_id', 'user_id', 'charge', 'created_at',
    ];

    public $timestamps = false;
}
