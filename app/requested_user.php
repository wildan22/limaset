<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class requested_user extends Model
{
    use SoftDeletes;
    protected $fillable = ['name','email','password','unit_id'];

    public function unit(){
        return $this->belongsTo('App\unit');
    }

}
