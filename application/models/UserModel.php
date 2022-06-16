<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;
use \Illuminate\Database\Eloquent\SoftDeletes;

class UserModel extends Eloquent
{
    use SoftDeletes;

    protected $table = 'users';
    protected $dates = ['deleted_at'];
    protected $fillable = ['email', 'full_name', 'password', 'token'];
}
