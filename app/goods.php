<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use \Askedio\SoftCascade\Traits\SoftCascadeTrait;


class goods extends Model
{
    use SoftDeletes;
    use SoftCascadeTrait;
    protected $fillable = [
        'device_type_id',
        'nama_barang',
        'serial_number',
        'processor',
        'ram_type_id',
        'ram_size',
        'storage_size',
        'unit_id',
        'operating_system_id',
        'computer_name',
        'wifi_mac',
        'lan_mac',
        'nomor_inventaris',
        'kondisi',
        'keterangan',
        'created_by',
        'tahun_perolehan',
    ];

    public function operating_system(){
        return $this->belongsTo('App\operating_system');
    }

    public function devicetype(){
        return $this->belongsTo('App\device_type','device_type_id');
    }

    public function unit(){
        return $this->belongsTo('App\unit');
    }

    public function ramtype(){
        return $this->belongsTo('App\ram_type','ram_type_id');
    }
}
