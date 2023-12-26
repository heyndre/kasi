<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePivot extends Model
{
    use HasFactory;

    protected $table = 'tutor_skills_pivot';
    protected $guarded = [];

    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function theCourse()
    {
        return $this->belongsTo(CourseBase::class, 'course_id', 'id');
    }

}
