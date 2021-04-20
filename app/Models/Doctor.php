<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary' , 'services'  , 'qualifications'  ,
        'lang' , 'lat' ,'from' , 'to' ,'status','user_id','created_at' ,'updated_at'
    ];

    public function user()
    {
        return $this->belongsTo(User::class  , 'user_id' , 'id');
    }

    public function scopeActive($query)
    {
        return $query -> where('status' , 1);
    }


    public static function validDoc()
    {
        return[
            'salary' => 'required|numeric',
            'services' => 'required',
            'qualifications' => 'required',
            'lang' => 'required',
            'lat' => 'required',
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'unique:users,id'
        ];
    }
}
