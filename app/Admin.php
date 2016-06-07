<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Auth\Authenticatable;

class Admin extends Model implements \Illuminate\Contracts\Auth\Authenticatable
{
    protected $table = 'admin';
    protected $fillable = ['name', 'password'];
    use Authenticatable;
}
