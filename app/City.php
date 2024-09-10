<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class City extends Model
{
    protected $table = 'citys';

    public function state()
    {
        return $this->belongsTo('App\State');
    }
}
