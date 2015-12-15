<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'user_id',
        'date',
        'total_price'
    ];

    public function products(){
        return $this->hasMany('App\product');
    }
}
