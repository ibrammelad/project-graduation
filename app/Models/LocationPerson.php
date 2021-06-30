<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class LocationPerson extends Model
{
    use HasFactory;

    protected $table ="location_people";

    public $fillable =[
        'lang' , 'lat' , 'user_id'
    ];
}
