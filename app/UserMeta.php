<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserMeta extends Model
{
    protected $fillable = [
        'cb',
        'adresse'
    ];

    /**
     * Get user related to this meta
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo {object} metas
     * metas
     */
    public function user(){
        return $this->belongsTo('App\User');
    }
}
