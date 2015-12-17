<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Tag extends Model
{
    protected $fillable = [
        'name',
        'slug'
    ];

    /**
     * Get products having the tag X
     * @return {object} products
     */
    public function products(){
        return $this->belongsToMany('App\Product', 'product_tag');
    }
}
