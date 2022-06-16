<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class ShipmentModel extends Eloquent
{
    protected $table = 'shipments';
    protected $fillable = [];

    public function order()
    {
        return $this->belongsTo(OrderModel::class);
    }
}
