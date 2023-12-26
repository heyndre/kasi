<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CourseBase extends Model
{
    use HasFactory;

    protected $table = 'tutor_skills';
    protected $guarded = [];

    public function tutorCourse()
    {
        return $this->hasMany(CoursePivot::class, 'course_id', 'id');
    }
    
    public function thePrice()
    {
        return $this->hasMany(CoursePrices::class, 'course_id', 'id');
    }
}
