<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Billing extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'bill_date' => 'datetime',
        'due_date' => 'datetime',
        'deadline' => 'datetime',
    ];

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function theStudentData()
    {
        return $this->hasOneThrough(User::class, Student::class, 'id', 'id', 'student_id', 'user_id');
    }

    public function theClass()
    {
        return $this->hasMany(Course::class, 'billing_id', 'id');
    }

    public function thePayment()
    {
        return $this->hasOne(Payment::class, 'billing_id', 'id');
    }
}
