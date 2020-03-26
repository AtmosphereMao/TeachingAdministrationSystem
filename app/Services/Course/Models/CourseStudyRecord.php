<?php

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class CourseStudyRecord extends Model
{
    use SoftDeletes;

    protected $table = 'course_study_records';

    protected $fillable = [
        'user_id', 'course_id',
        'video_id', 'progress',
        'is_over'
    ];
}
