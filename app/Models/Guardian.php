<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Guardian extends Model
{
    use HasFactory;

    protected $guarded = [];

    public function userData()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function theChildren()
    {
        return $this->hasMany(Student::class, 'guardian_id');
    }
}
