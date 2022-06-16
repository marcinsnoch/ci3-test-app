<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class LocationModel extends Eloquent
{
    protected $table = 'locations';
    protected $fillable = ['name', 'description'];
}
