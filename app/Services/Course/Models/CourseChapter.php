<?php

/*
 *
 * This source file is subject to the MIT license that is bundled
 * with this source code in the file LICENSE.
 */

namespace App\Services\Course\Models;

/**
 * App\Services\Course\Models\CourseChapter
 *
 * @property int $id
 * @property int $course_id
 * @property string $title
 * @property \Illuminate\Support\Carbon|null $created_at
 * @property \Illuminate\Support\Carbon|null $updated_at
 * @property int $sort
 * @property-read \App\Services\Course\Models\Course $course
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Services\Course\Models\Video[] $videos
 * @property-read int|null $videos_count
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter newModelQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter newQuery()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter query()
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereCourseId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereCreatedAt($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereId($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereSort($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereTitle($value)
 * @method static \Illuminate\Database\Eloquent\Builder|\App\Services\Course\Models\CourseChapter whereUpdatedAt($value)
 * @mixin \Eloquent
 */
class CourseChapter extends Base
{
    protected $table = 'course_chapter';

    protected $fillable = [
        'course_id', 'title', 'sort',
    ];

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function course()
    {
        return $this->belongsTo(Course::class, 'course_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function videos()
    {
        return $this->hasMany(Video::class, 'chapter_id');
    }
}
