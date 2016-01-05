<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class History extends Model
{
    protected $fillable = [
        'id',
        'user_id',
        'order_date',
        'total_price'
    ];

    /**
     * Get products associated with history
     * @return {object} products
     */
    public function products(){
        return $this->belongsToMany('App\Product', 'history_product');
    }

    public function user(){
        return $this->belongsTo('App\User');
    }
}
