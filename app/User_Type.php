<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User_Type extends Model
{
    protected $table = 'user_type';

    public $timestamps = false;

    public function users() {
        return $this->hasOne('App\User');
    }
}
