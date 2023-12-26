<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CoursePrices extends Model
{
    use HasFactory;

    protected $table = 'prices', $guarded = [];

    public function theCourse()
    {
        return $this->belongsTo(CourseBase::class, 'course_id', 'id');
    }
}
