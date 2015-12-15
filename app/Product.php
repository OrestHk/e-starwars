<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'slug',
        'name',
        'description',
        'short_text',
        'status',
        'image_id',
        'category_id',
        'price'
    ];

    public function tags(){
        return $this->hasMany('App\tag');
    }

    public function category(){
        return $this->belongsTo('App\category');
    }

    public  function history(){
        return $this->hasMany('App\history');
    }
}
