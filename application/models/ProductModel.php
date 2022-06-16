<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class ProductModel extends Eloquent
{
    use SoftDeletes;

    protected $table = 'products';
    protected $fillable = ['number', 'name', 'quantity', 'location_id', 'warehouse_id', 'user_id'];

    public function location()
    {
        return $this->belongsTo(LocationModel::class);
    }

    public function deliveries()
    {
        return $this->hasMany(DeliveryModel::class, 'product_id');
    }

    public function warehouse()
    {
        return $this->belongsTo(WarehouseModel::class);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }

    public function allocations()
    {
        return $this->hasMany(AllocationModel::class, 'product_id');
    }
}
