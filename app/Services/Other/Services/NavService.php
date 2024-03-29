<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Services;

use App\Services\Other\Models\Nav;
use App\Services\Other\Interfaces\NavServiceInterface;

class NavService implements NavServiceInterface
{
    /**
     * @return array
     */
    public function all(): array
    {
        return Nav::orderBy('sort')->get()->toArray();
    }
}
