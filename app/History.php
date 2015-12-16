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

    /**
     * Get products associated with history
     * @return {object} products
     */
    public function products(){
        return $this->belongsToMany('App\Product', 'history_product');
    }
}
