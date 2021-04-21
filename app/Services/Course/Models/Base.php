<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Course\Models\Base
 *
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Base newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Base newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Base query()
 * @mixin \Eloquent
 */
class Base extends Model
{
    /**
     * 查询字段.
     *
     * @param bool $id
     *
     * @return array|int
     */
    public function getSelectFields($id = true)
    {
        $fields = $this->fillable;
        $id && $fields = array_push($fields, 'id');

        return $fields;
    }
}
