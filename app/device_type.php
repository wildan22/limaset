<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;

class device_type extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $fillable = ['nama_perangkat','category_id','kode_inventaris'];
    protected $softCascade = ['goods'];

    public function category(){
        return $this->belongsTo('App\category');
    }

    public function goods(){
        return $this->hasMany('App\goods');
    }
}
