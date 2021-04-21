<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Other\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Other\Models\Slider
 *
 * @property int $id
 * @property string $thumb
 * @property int $sort
 * @property string $url
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Other\Models\Slider onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Other\Models\Slider whereUrl($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Other\Models\Slider withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Other\Models\Slider withoutTrashed()
 * @mixin \Eloquent
 */
class Slider extends Model
{
    use SoftDeletes;

    protected $table = 'sliders';

    protected $fillable = [
        'thumb', 'sort', 'url',
    ];
}
