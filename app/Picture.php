<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Image extends Model
{
    protected $fillable = [
        'filename',
        'dasizete',
        'type'
    ];

    public function product(){
        return $this->belongsTo('App\product');
    }
}
