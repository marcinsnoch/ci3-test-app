<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\Model as Eloquent;

class AllocationModel extends Eloquent
{
    protected $table = 'account_product';
    protected $fillable = [];

    public function account()
    {
        return $this->belongsTo(AccountModel::class);
    }

    public function product()
    {
        return $this->belongsTo(ProductModel::class);
    }
}
