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

use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * App\Services\Course\Models\Course
 *
 * @property int $id
 * @property int $user_id
 * @property string $title 名
 * @property string $slug slug
 * @property string $thumb 封面
 * @property int $charge 收费
 * @property string $short_description 简短介绍
 * @property string $original_desc 简介原始内容
 * @property string $render_desc 简介渲染后的内容
 * @property string $seo_keywords SEO关键字
 * @property string $seo_description SEO描述
 * @property string|null $published_at 上线时间
 * @property int $is_show 1显示,-1隐藏
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property \Illuminate\Support\Carbon|null $deleted_at
 * @property int $category_id 分类id
 * @property int $is_rec 推荐,0否,1是
 * @property int $user_count 学习人数
 * @property-read \App\Services\Course\Models\CourseCategory $category
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Course\Models\CourseChapter[] $chapters
 * @property-read int|null $chapters_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Course\Models\CourseComment[] $comments
 * @property-read int|null $comments_count
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Course\Models\Video[] $videos
 * @property-read int|null $videos_count
 * @method static bool|null forceDelete()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course keywords($keywords)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course notShow()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\Course onlyTrashed()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course published()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course recommend()
 * @method static bool|null restore()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course show()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereCategoryId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereCharge($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereDeletedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereIsRec($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereIsShow($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereOriginalDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course wherePublishedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereRenderDesc($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereSeoDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereSeoKeywords($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereShortDescription($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereSlug($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereThumb($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereUpdatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereUserCount($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\Course whereUserId($value)
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\Course withTrashed()
 * @method static \Illuminate\Database\Query\Builder|\App\Services\Course\Models\Course withoutTrashed()
 * @mixin \Eloquent
 */
class Course extends Base
{
    use SoftDeletes;

    const SHOW_YES = 1;
    const SHOW_NO = -1;

    const REC_YES = 1;
    const REC_NO = 0;

    protected $table = 'courses';

    protected $fillable = [
        'user_id', 'title', 'slug', 'thumb', 'charge',
        'short_description', 'original_desc', 'render_desc', 'seo_keywords',
        'seo_description', 'published_at', 'is_show', 'category_id',
        'is_rec', 'user_count',
    ];

    protected $hidden = [
        'deleted_at',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function chapters()
    {
        return $this->hasMany(CourseChapter::class, 'course_id');
    }

    /**
     * 该课程下面的视频.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'course_id', 'id');
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
        return $query->where('is_show', self::SHOW_YES);
    }

    /**
     * @param $query Model
     * @return mixed
     */
    public function scopeRecommend($query)
    {
        return $query->where('is_rec', self::REC_YES);
    }


    /**
     * 作用域：不显示.
     *
     * @param $query Model
     *
     * @return mixed
     */
    public function scopeNotShow($query)
    {
        return $query->where('is_show', self::SHOW_NO);
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
     * 作用域：关键词搜索.
     *
     * @param $query Model
     * @param string $keywords
     *
     * @return mixed
     */
    public function scopeKeywords($query, string $keywords)
    {
        $keywords && $query->where('title', 'like', "%{$keywords}%");

        return $query;
    }

    /**
     * 评论.
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function comments()
    {
        return $this->hasMany(CourseComment::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function category()
    {
        return $this->belongsTo(CourseCategory::class, 'category_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function tag()
    {
        return $this->hasMany(CourseTagLink::class, 'course_id');
    }
}
