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

class CourseTag extends Model
{
    protected $table = 'course_tags';

    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = 0;

    protected $fillable = [
         'name', 'is_show',
    ];

    /**
     * @param $query
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->whereIsShow(self::IS_SHOW_YES);
    }


}
