<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Carbon\Carbon;

// class User extends Authenticatable implements MustVerifyEmail//buy pass verify email
class User extends Authenticatable 
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'username',
        'email',
        'google_id',
        'phone',
        'address',
        'password',
        // 'profile_pic'
    ];

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
        // 'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_pic',
    ];
    // public function setEmailVerifiedAtAttribute($value)
    // {
    //     if (!is_null($value)) {
    //         $this->attributes['email_verified_at'] = $value;
    //     } else {
    //         // Check if the attribute value was already set manually
    //         if (isset($this->attributes['email_verified_at'])) {
    //             $this->attributes['email_verified_at'] = Carbon::parse($this->attributes['email_verified_at']);
    //         } else {
    //             $this->attributes['email_verified_at'] = Carbon::now();
    //         }
    //     }
    // }
    public function getProfilePicAttribute()
{
    // Your logic to retrieve the profile picture URL or file path
}

}
