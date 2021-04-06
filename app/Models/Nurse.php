<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Nurse extends Model
{
    use HasFactory;

    protected $fillable = [
        'salary' , 'services'  , 'qualifications'  , 'from' , 'to' , 'created_at' ,'updated_at'
    ];
}
