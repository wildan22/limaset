<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class operating_system extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $fillable = ['os_name'];
    protected $softCascade = ['goods'];

    public function goods(){
        return $this->hasMany('App\goods');
    }
}
