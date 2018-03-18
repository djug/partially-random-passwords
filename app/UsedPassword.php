<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UsedPassword extends Model
{
    protected $fillable = ['user_id', 'password'];
}
