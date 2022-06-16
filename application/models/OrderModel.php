<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class OrderModel extends Eloquent
{
    protected $table = 'orders';
    protected $fillable = [];

    public function address()
    {
        return $this->belongsTo(AddressModel::class);
    }

    public function shipments()
    {
        return $this->hasMany(ShipmentModel::class, 'order_id');
    }

    public function products()
    {
        return $this->belongsToMany(ProductModel::class, 'order_product', 'order_id', 'product_id');
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
