<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class device_type extends Model
{
    use SoftDeletes;
    protected $fillable = ['nama_perangkat','category_id'];

    public function category(){
        return $this->belongsTo('App\category');
    }
}
