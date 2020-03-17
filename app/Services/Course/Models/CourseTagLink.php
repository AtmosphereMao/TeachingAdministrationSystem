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

class CourseTagLink extends Model
{
    protected $table = 'course_tags_link';


    protected $fillable = [
        'tag_id', 'course_id'
    ];

}
