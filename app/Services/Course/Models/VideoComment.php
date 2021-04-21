<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Course\Models\VideoComment
 *
 * @property int $id
 * @property int $user_id
 * @property int $video_id
 * @property string $original_content 原始内容
 * @property string $render_content 渲染后的内容
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property-read \App\Services\Course\Models\Video $video
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment newQuery()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\VideoComment onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment query()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereOriginalContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereRenderContent($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\VideoComment whereVideoId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\VideoComment withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\VideoComment withoutTrashed()
 * @mixin \Eloquent
 */
class VideoComment extends Base
{
    use SoftDeletes;

    protected $table = 'video_comments';

    protected $fillable = [
        'user_id', 'video_id', 'original_content', 'render_content',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    public function video()
    {
        return $this->belongsTo(Video::class, 'video_id');
    }
}
