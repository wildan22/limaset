<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;


class ram_type extends Model
{
    use SoftDeletes;
    protected $fillable = ['tipe_ram'];
}
