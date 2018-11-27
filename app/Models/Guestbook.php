<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Guestbook extends Model
{
    protected $fillable = [
        'category_id','title','content','name','mobile','email','address','ip','extra',
    ];
}
