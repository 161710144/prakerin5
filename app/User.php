<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];
    public $timestamps = true;
    public function Member(){
        return $this->HasOne('App\Member','user_id');
    }
    public function Perusahaan(){
        return $this->HasOne('App\Perusahaan','user_id');
    }
    public function Lamaran(){
        return $this->HasOne('App\Lamaran','user_id');
    }

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];
}
