<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class category extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $fillable = ['category_name'];
    protected $softCascade = ['device_type'];

    public function device_type(){
        return $this->hasMany('App\device_type');
    }
}


