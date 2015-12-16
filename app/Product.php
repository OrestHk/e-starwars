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
        'price',
        'publish_date'
    ];

    /**
     * Get product picture
     * @return {object} picture
     */
    public function picture(){
        return $this->belongsTo('App\Picture');
    }
    /**
     * Get tags associated with product
     * @return {object} tags
     */
    public function tags(){
        return $this->belongsToMany('App\Tag', 'product_tag');
    }
    /**
     * Get product category
     * @return {object} category
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    public  function history(){
        return $this->hasMany('App\History');
    }
}
