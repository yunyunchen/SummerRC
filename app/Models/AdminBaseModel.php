<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class AdminBaseModel extends Model
{
    //

    protected $connection='im_mysql';

    public $timestamps=false;
}
