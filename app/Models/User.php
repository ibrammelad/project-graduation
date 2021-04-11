<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable , HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */

    const showMAIL = 1 ;
    const showName = 1 ;
    const showNearly = 1 ;
    const HaveCovid19 = 0 ;
    protected $fillable = [
        	'name', 'email', 'phone'	, 'token', 'status',	'image',
            'showMail',	'showName',	'showNearly',	'HaveCovid19',	'doctor_details_id',
            'nurse_details_id',	'email_verified_at','password'	,'created_at',	'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];
}
