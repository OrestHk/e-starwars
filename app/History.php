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
     * @return \Illuminate\Database\Eloquent\Relations\BelongsToMany {object} products
     *
     */
    public function products(){
        return $this->belongsToMany('App\Product', 'history_product');
    }

    /**
     *Get user associated with history
     * @return \Illuminate\Database\Eloquent\Relations\belongTo {object} user
     *
     */
    public function user()
    {
        return $this->belongsTo('App\User');
    }
}
