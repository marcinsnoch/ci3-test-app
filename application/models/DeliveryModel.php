<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class DeliveryModel extends Eloquent
{
    protected $table = 'deliveries';
    protected $fillable = ['date', 'quantity', 'user_id'];

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }

    public function user()
    {
        return $this->belongsTo(UserModel::class);
    }
}
