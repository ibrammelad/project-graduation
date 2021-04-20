<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Validation\Rule;
use Laravel\Sanctum\HasApiTokens;
use Laravel\Sanctum\PersonalAccessToken;

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
            'showMail',	'showName',	'showNearly',	'HaveCovid19','HelpUsers',
            	'email_verified_at','password'	,'created_at',	'updated_at'
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


    public static function validUpdate($id)
    {
        return [
            'name' => 'required|min:3|max:50',
            'email' => 'required|email|' . Rule::unique('users', 'email')->ignore($id),
            'phone' => 'required|' . Rule::unique('users', 'phone')->ignore($id),
        ];
    }

    public static function assurence($id)
    {
        return PersonalAccessToken::where('name', 'LIKE', auth()->user()->name)->
        Where('tokenable_id', 'LIKE', $id)->
        where('tokenable_type', 'App\Models\User')->
        get();
    }


    public function doctor()
    {
        return $this->hasOne(Doctor::class);
    }
    public function nurse()
    {
        return $this->hasOne(Doctor::class);
    }

}
