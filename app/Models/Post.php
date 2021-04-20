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

}

