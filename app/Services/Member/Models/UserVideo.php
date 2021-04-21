<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Member\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Services\Member\Models\UserVideo
 *
 * @property int $user_id
 * @property int $video_id
 * @property int $charge 收费
 * @property string|null $created_at
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Member\Models\UserVideo whereVideoId($value)
 * @mixin \Eloquent
 */
class UserVideo extends Model
{
    protected $table = 'user_video';

    protected $fillable = [
        'user_id', 'video_id', 'charge', 'created_at',
    ];

    public $timestamps = false;
}
