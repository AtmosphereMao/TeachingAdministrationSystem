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

/**
 * App\Services\Course\Models\Video
 *
 * @property int $id
 * @property int $user_id
 * @property int $course_id
 * @property string $title 标题
 * @property string $slug slug
 * @property string $url 播放地址
 * @property int $charge 价格
 * @property int $view_num 观看次数
 * @property string $short_description 简短介绍
 * @property string $original_desc 简介原始内容
 * @property string $render_desc 简介渲染后的内容
 * @property string $seo_keywords SEO关键字
 * @property string $seo_description SEO描述
 * @property string|null $published_at 上线时间
 * @property int $is_show 1显示,-1隐藏
 * @property string|null $deleted_at
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property string|null $aliyun_video_id
 * @property int $chapter_id
 * @property int $duration 时长，单位：秒
 * @property string|null $tencent_video_id 腾讯云video_id
 * @property-read \App\Services\Course\Models\CourseChapter $chapter
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Course\Models\VideoComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \App\Services\Course\Models\Course $course
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video show()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereAliyunVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereChapterId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereDuration($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereOriginalDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereRenderDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereTencentVideoId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereUrl($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereUserId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Video whereViewNum($value)
 * @mixin \Eloquent
 */
class Video extends Base
{
    const IS_SHOW_YES = 1;
    const IS_SHOW_NO = -1;

    protected $table = 'videos';

    protected $fillable = [
        'user_id', 'course_id', 'title', 'slug',
        'url', 'view_num', 'short_description', 'original_desc', 'render_desc',
        'seo_keywords', 'seo_description', 'published_at',
        'is_show', 'charge', 'aliyun_video_id',
        'chapter_id', 'duration', 'tencent_video_id',
        'huaiwei_video_id'
    ];

    /**
     * 所属课程.
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id', 'id');
    }

    /**
     * 作用域：显示.
     *
     * @param $query Model
     *
     * @return mixed
     */
    public function scopeShow($query)
    {
        return $query->where('is_show', self::IS_SHOW_YES);
    }

    /**
     * 作用域：上线的视频.
     *
     * @param $query Model
     *
     * @return mixed
     */
    public function scopePublished($query)
    {
        return $query->where('published_at', '<=', date('Y-m-d H:i:s'));
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(VideoComment::class, 'video_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function chapter()
    {
        return $this->belongsTo(CourseChapter::class, 'chapter_id');
    }
}
