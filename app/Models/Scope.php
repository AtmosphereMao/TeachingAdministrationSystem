<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Models;

trait Scope
{
    public function scopeDes($query)
    {
        return $query->orderByDesc('created_at');
    }
}
