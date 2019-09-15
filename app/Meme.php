<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $primaryKey = 'id';

    public function meme()
    {
        return $this->hasMany('App\Comment');
    }
}
