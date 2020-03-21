<?php

namespace App\Services\Course\Models;

use Illuminate\Database\Eloquent\Model;

class CourseVisitor extends Model
{
    protected $table = 'course_visitor';
    protected $fillable = [
        'ip','county','city', 'course_id','clicks'
    ];
    public function course()
    {
        return $this->belongsTo(Course::class);
    }
}
