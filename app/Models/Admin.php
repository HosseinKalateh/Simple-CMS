<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class Admin extends Authenticatable
{
    use Notifiable;

    protected $guarded = 'admin';

    protected $fillable = [
      'first_name', 'last_name', 'email', 'password'
    ];

    protected $hidden = [
      'password', 'remember_Token'
    ];

    // Get admin full name
    public function getFullName()
    {
        return $this->first_name." ".$this->last_name;
    }


}
