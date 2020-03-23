<?php

namespace App;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

use Illuminate\Database\Eloquent\Model;

class unit extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $fillable = ['alias','keterangan','color'];
    public function User(){
        return $this->hasMany('App\User');
    }
}
