<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class WarehouseModel extends Eloquent
{
    protected $table = 'warehouses';
    protected $fillable = [];
}
