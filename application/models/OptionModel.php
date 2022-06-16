<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class OptionModel extends Eloquent
{
    protected $table = 'options';
    protected $fillable = ['name', 'title', 'value'];
}
