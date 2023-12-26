<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_of_event' => 'datetime',
        'student_attendance' => 'datetime',
        'tutor_attendance' => 'datetime',
        // 'additional_links' => 'array',
    ];
    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function theCourse()
    {
        return $this->hasOneThrough(CourseBase::class, CoursePivot::class, 'id', 'id', 'course_id', 'skill_id');
    }
}
