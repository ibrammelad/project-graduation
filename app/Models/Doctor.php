<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Doctor extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary' , 'services'  , 'qualifications'  , 'image',
        'lang' , 'lat' , 'address','from' , 'to' ,'review','status','user_id','created_at' ,'updated_at'
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
            'salary' => 'required',
            'services' => 'required',
            'qualifications' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg',
            'lang' => 'required',
            'lat' => 'required',
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'unique:users,id',
            'address' =>'required',
        ];
    }
}
