<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Category extends Model
{

    protected $fillable = [
        'name',
        'slug',
        'description'
    ];

    /**
     * Get products wih the category X
     * @return {object} products
     */
    public function products(){
        return $this->hasMany('App\Product');
    }
}
