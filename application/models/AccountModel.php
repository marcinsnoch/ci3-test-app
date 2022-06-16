<?php

defined('BASEPATH') or exit('No direct script access allowed');

use \Illuminate\Database\Eloquent\SoftDeletes;
use \Illuminate\Database\Eloquent\Model as Eloquent;

class AccountModel extends Eloquent
{
    use SoftDeletes;

    protected $table = 'accounts';
    protected $fillable = ['name'];

    public function products()
    {
        return $this->hasMany(AllocationModel::class, 'account_id');
    }
}
