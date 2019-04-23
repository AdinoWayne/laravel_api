<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Laravel\Passport\HasApiTokens;

class Owner extends Authenticatable
{
    use Notifiable, HasApiTokens;

    protected $table = 'owner';

    protected $fillable = [
        'id', 'owner_id', 'name', 'person_name', 'add_text', 'email', 'tel', 'url', 'note', 'pass'
    ];

    protected $hidden = [
        'pass'
    ];

    public function Items() {
        return $this->hasOne('App\Models\Items');
    }
}
