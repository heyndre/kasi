<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Builder;

class User extends Authenticatable
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    // use \Spatie\WelcomeNotification\ReceivesWelcomeNotification;
    use HasSlug;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    // protected $fillable = [
    //     'name',
    //     'email',
    //     'password',
    //     'mobile_number',
    //     'last_login_at',
    //     'last_active_at',
    //     'profile_photo_path',
    //     'birthday',
    //     'exist_status',
    // ];

    protected $guarded = [];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'last_login_at' => 'datetime',
        'last_active_at' => 'datetime',
        'birthday' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    // public function getRoleAttribute() {
    //     return $this->role;
    // }

    public function theStudent()
    {
        return $this->hasOne(Student::class, 'user_id', 'id');
    }

    public function theTutor()
    {
        return $this->hasOne(Tutor::class, 'user_id', 'id');
    }

    public function theGuardian()
    {
        return $this->hasOne(Guardian::class, 'user_id', 'id');
    }

    public function nextAnniversary(): Attribute

    {
        return Attribute::make(
            get: function () {
                $date = $this->birthday;
                $date->setYear(now()->year);
                if ($date->isPast()) {
                    $date->addYear();
                }
                return $date;
            }
        );
    }

    public function getSlugOptions(): SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom(['name', 'role'])
            ->saveSlugsTo('slug')
            ->doNotGenerateSlugsOnUpdate();
    }

    /**
     * Get the route key for the model.
     *
     * @return string
     */
    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function scopeManagement(Builder $query): void
    {
        $query->where('role', 'ADMIN')->orWhere('role', 'SUPERADMIN');
    }

    public function isAdmin()
    {
        if ($this->role == 'ADMIN') {
            return true;
        } else {
            return false;
        }
    }

    
    public function isSuperAdmin()
    {
        if ($this->role == 'SUPERADMIN') {
            return true;
        } else {
            return false;
        }
    }

    
    public function isStudent()
    {
        if ($this->role == 'MURID') {
            return true;
        } else {
            return false;
        }
    }

    
    public function isTutor()
    {
        if ($this->role == 'Tutor') {
            return true;
        } else {
            return false;
        }
    }

    
    public function isGuardian()
    {
        if ($this->role == 'WALI MURID') {
            return true;
        } else {
            return false;
        }
    }
}
