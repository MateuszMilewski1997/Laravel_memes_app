<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    protected $primaryKey = 'id';

    public function meme()
    {
        return $this->belongsTo('App\Meme');
    }
}
