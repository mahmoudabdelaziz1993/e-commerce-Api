<?php

namespace App;


use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use Notifiable,HasApiTokens;
    // define the const 
    const VARIFIED_USER='1';
    const UNVARIFIED_USER='0';

    const ADMIN_USER='true';
    const REGULAR_USER='false';
    protected $table ='users';


    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
         'email',
          'password',
          'varified',
          'varified_token',
          
          'admin',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
      // 'varified_token',
     */
    protected $hidden = [
        'password', 'remember_token','varified_token',
    
    ];
    public function isvarified()
    {
        # code...
        return $this->varified==User::VARIFIED_USER;
    }
    public function isAdmin()
    {
        # code...
        return $this->admin==User::ADMIN_USER;

    }
    public static function generateVarificationCode()
    {
        # code...
        return str_random(40);
    }

}
