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
        'picture_id',
        'category_id',
        'price',
        'publish_date'
    ];

    /**
     * Get product picture
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo {object} picture
     * picture
     */
    public function picture(){
        return $this->belongsTo('App\Picture');
    }

    /**
     * Get tags associated with product
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany {object} tags
     * tags
     */
    public function tags(){
        return $this->belongsToMany('App\Tag', 'product_tag');
    }

    /**
     * Get product category
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo {object} category
     * category
     */
    public function category(){
        return $this->belongsTo('App\Category');
    }

    /**
     * Get product history
     * @return \Illuminate\Database\Eloquent\Relations\hasMany {object} history
     * history
     */
    public  function history(){
        return $this->hasMany('App\History');

    }

    /**
     * check product tags
     * @param $id
     * @return bool
     */
    public function hasTag($id){
      foreach ($this->tags as $tag){
        if($tag->id === $id)return true;
      }
    return false;
    }

    /**
     * format date
     * @return bool|string
     */
    public function dateConfert(){
       return date('d/m/Y',strtotime($this->publish_date));
    }

}
