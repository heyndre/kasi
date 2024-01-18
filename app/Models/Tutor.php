<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Tutor extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function thePayment()
    {
        return $this->hasMany(TutorPayment::class, 'tutor_id', 'id');
    }

    public function theSession()
    {
        return $this->hasMany(Course::class, 'tutor_id', 'id');
    }

    public function theSkill()
    {
        return $this->hasManyThrough(CourseBase::class, CoursePivot::class, 'tutor_id', 'id', 'id', 'skill_id');
    }

    public function theSkillPivot()
    {
        return $this->hasManyThrough(CourseBase::class, CoursePivot::class, 'tutor_id', 'id', 'id', 'skill_id');
    }

    public function getEduLevelAttribute($value)
    {
        switch ($value) {
            case 'sd':
                return 'Sekolah Menengah Dasar';
            case 'smp':
                return 'Sekolah Menengah Pertama/Ekuivalen';
            case 'sma':
                return 'Sekolah Menengah Atas/Ekuivalen';
            case 's1':
                return 'Mahasiswa Jenjang S1';
            case 's2':
                return 'Mahasiswa Jenjang S2';
            case 's3':
                return 'Mahasiswa Jenjang S3';
        }
    }


    public function getEduStatusAttribute($value)
    {
        switch ($value) {
            case '0':
                return 'Sedang Menempuh Studi';
            case '1':
                return 'Sudah Menyelesaikan Studi';
        }
    }

    public function getWorkTitleAttribute($value)
    {
        switch ($value) {
            case 'unemployed':
                return 'Tidak Memiliki Pekerjaan';
            case 'housewife':
                return 'Ibu Rumah Tangga';
            case 'privateemployee':
                return 'Karyawan Swasta';
            case 'civilemployee':
                return 'Pegawai Negeri Sipil';
            case 'freelance':
                return 'Freelance';
            case 'teacher':
                return 'Guru/Tenaga Pengajar';
            case 'other':
                return 'Lain-lain';
        }
    }
}
