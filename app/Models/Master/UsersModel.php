<?php

namespace App\Models\Master;

use Illuminate\Database\Eloquent\Model;

class UsersModel extends Model
{
    protected $table 	= 'users';
    protected $fillable = ['name','email','email_verified_at','username','password','remember_token','level','kapal','password2'];
}
