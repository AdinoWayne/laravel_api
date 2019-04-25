<?php

namespace App\Models;

use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Tymon\JWTAuth\Contracts\JWTSubject;

class Owner extends Authenticatable implements JWTSubject
{
    use Notifiable;

    protected $table = 'owner';

    protected $guard = 'owner';

    protected $fillable = [
        'id', 'owner_id', 'name', 'person_name', 'add_text', 'email', 'tel', 'url', 'note', 'password'
    ];

    protected $hidden = [
        'password'
    ];

    public function Items() {
        return $this->hasOne('App\Models\Items');
    }

    public function getJWTIdentifier()
    {
        return $this->getKey();
    }
    public function getJWTCustomClaims()
    {
        return [];
    }
    
}
