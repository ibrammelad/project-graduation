<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPersonInteract extends Model
{
    use HasFactory;

    protected $fillable = [
        'lang' , 'address' , 'user_1' , 'user_2' , 'lat'
    ];


    public function user()
    {
       return $this->belongsTo(User::class);
    }
}
