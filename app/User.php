<?php

namespace App;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use BenSampo\Enum\Traits\CastsEnums;
use App\Enums\UserType;

class User extends Authenticatable
{
    use Notifiable, CastsEnums;

    protected $enumCasts = [
            'user_type' => UserType::class,
        ];

    protected $appends = ['user_type_name'];
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'user_type' => 'integer'
    ];

    public function getUserTypeNameAttribute() {
        return $this->user_type->key;
    }
}
