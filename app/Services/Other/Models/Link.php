<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Other\Models\Link
 *
 * @property int $id
 * @property int $sort
 * @property string $name
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereName($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Link whereUrl($value)
 * @mixin \Eloquent
 */
class Link extends Model
{
    protected $table = 'links';

    protected $fillable = ['sort', 'name', 'url'];
}
