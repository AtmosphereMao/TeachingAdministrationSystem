<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Services;

use App\Services\Other\Models\IndexBanner;
use App\Services\Other\Interfaces\IndexBannerServiceInterface;

class IndexBannerService implements IndexBannerServiceInterface
{
    public function all(): array
    {
        return IndexBanner::orderBy('sort')->get()->toArray();
    }
}
