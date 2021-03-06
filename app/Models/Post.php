<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;


    protected $fillable =[
       'text' , 'user_id' , 'image' , 'created_at' , 'updated_at'
    ];

    public function comment()
    {
        return $this->hasMany(Comment::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);

    }

    public function SaveUser()
    {
        return $this->hasMany(User::class);

    }
}

