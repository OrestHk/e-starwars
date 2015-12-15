<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = [
        'cb',
        'adresse'

    ];

    public function user(){
        return $this->belongsTo('App\user');
    }
}
