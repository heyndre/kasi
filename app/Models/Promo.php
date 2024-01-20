<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
    use HasFactory;

    protected $guarded = [];
    protected $casts = [
        'start_date' => 'datetime',
        'end_date' => 'datetime',
    ];

    public function theBill()
    {
        return $this->hasMany(Billing::class, 'promo_code', 'code');
    }

    // public function getTypeAttribute($value)
    // {
    //     switch ($value) {
    //         case 'flat':
    //             return 'Flat';
    //         case 'Percentage':
    //             return 'Persen';
    //     }
    // }
}
