<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Meme extends Model
{
    protected $primaryKey = 'id';

    public function memes()
    {
        return $this->hasMany('App\Comment');
    }
}
