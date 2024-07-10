<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class StudentPreferences extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id');
    }
}
