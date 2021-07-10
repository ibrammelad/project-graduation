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
    protected $fillable = [
        'name', 'email' ,'password','phone','token','code','status','image',
        'showMail','showName','showNearly','susbected19','symptoms19','HaveCovid19','HelpUsers','FCMToken',
        'created_at',	'updated_at'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'code'
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
        return $this->hasOne(Nurse::class);
    }

    public function location()
    {
        return $this->hasOne(LocationPerson::class);
    }

    public function post()
    {
        return $this->hasMany(Post::class);
    }
    public function likes()
    {
        return $this->hasMany(Like::class);
    }

    public function SavePosts()
    {
        return $this->hasMany(Post::class);

    }

    public function scopeActiveHelp($query)
    {
        return $this->where('HelpUsers' , 1 ) ;
    }

}
