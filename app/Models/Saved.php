<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Saved extends Model
{
    use HasFactory;

    protected $fillable=[
      'post_id' , 'user_id' , 'saved' ,
    ];

    public function scopeActive($query)
    {
        return $query -> where('saved' , 1);
    }


    public function posts()
    {
        return $this->belongsTo(Post::class);
    }
}
