<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary' , 'services'  , 'qualifications'  ,'review', 'from' , 'to' ,'user_id', 'status', 'created_at' ,'updated_at'
    ];


    public function user()
    {
        return $this->belongsTo(User::class , 'user_id' , 'id');
    }
    public function scopeActive($query)
    {
        return $query -> where('status' , 1);
    }

    public static function validNurse()
    {
        return[
            'salary' => 'required',
            'services' => 'required',
            'qualifications' => 'required',
            'from' => 'required',
            'to' => 'required',
            'user_id' => 'unique:users,id'
        ];
    }




}
