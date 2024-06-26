<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Student extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function theGuardian()
    {
        return $this->belongsTo(Guardian::class, 'guardian_id', 'id');
        // return $this->hasOne(Guardian::class, 'id', 'guardian_id');
    }

    public function thePackage() {
        return $this->hasMany(Package::class, 'student_id');
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
            case '1':
                return 'Sedang Menempuh Studi';
            case '0':
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
