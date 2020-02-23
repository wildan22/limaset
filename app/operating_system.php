<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class operating_system extends Model
{
    use SoftDeletes;
    protected $fillable = ['os_name'];
}
