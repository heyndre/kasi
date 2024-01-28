<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class Course extends Model
{
    use HasFactory;

    protected $guarded = [];

    protected $casts = [
        'date_of_event' => 'datetime',
        'student_attendance' => 'datetime',
        'tutor_attendance' => 'datetime',
        'tutor_finish_confirm' => 'datetime',
        // 'class_end_time' => 'datetime',
        'additional_links' => 'array',
        'files' => 'array',
    ];


    public function theTutor()
    {
        return $this->belongsTo(Tutor::class, 'tutor_id', 'id');
    }

    public function theStudent()
    {
        return $this->belongsTo(Student::class, 'student_id', 'id');
    }

    public function theBilling()
    {
        return $this->belongsTo(Billing::class, 'billing_id', 'id');
    }

    public function theCourse()
    {
        // return $this->hasOneThrough(CourseBase::class, CoursePivot::class, 'id', 'id', 'course_id', 'skill_id');
        return $this->hasOne(CourseBase::class, 'id', 'course_id');
    }

    public function theSharing()
    {
        return $this->belongsTo(TutorPayment::class, 'tutor_payment_id', 'id');
    }

    public function statusName()
    {
        if (session('language') == 'id') {
            if ($this->status == 'WAITING') {
                return 'Menunggu Pelaksanaan Kelas';
            } else if ($this->status == 'RUNNING') {
                return 'Kelas sedang dilaksanakan';
            } else if ($this->status == 'CONDUCTED') {
                return 'Kelas selesai';
            } else if ($this->status == 'CANCELLED') {
                return 'Kelas dibatalkan';
            } else if ($this->status == 'BURNED') {
                return 'Kelas selesai tanpa kehadiran murid';
            } else if ($this->status == 'NEEDCONFIRMATION') {
                return 'Menunggu konfirmasi Admin KASI';
            }
        } else {
            if ($this->status == 'WAITING') {
                return 'Waiting to be started';
            } else if ($this->status == 'RUNNING') {
                return 'Class being held';
            } else if ($this->status == 'CONDUCTED') {
                return 'Class was conducted';
            } else if ($this->status == 'CANCELLED') {
                return 'Class cancelled';
            } else if ($this->status == 'BURNED') {
                return 'Class was conducted without student';
            } else if ($this->status == 'NEEDCONFIRMATION') {
                return 'Waiting Admin KASI Confirmation';
            } 
        }
    }
}
