<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderCorona extends Model
{
    use HasFactory;

    protected $table = "order_coronas" ;
    protected $fillable=[
      'image_cro'   , 'image_susb' , 'user_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
