<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateGoodsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('goods', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->integer('device_type_id')->unsigned();
            $table->string('nama_barang');
            $table->string('serial_number');
            $table->string('processor')->nullable();
            $table->integer('ram_type_id')->unsigned()->nullable();
            $table->integer('ram_size')->nullable();
            $table->integer('storage_size')->nullable();
            $table->integer('unit_id')->unsigned()->nullable();
            $table->integer('operating_system_id')->unsigned()->nullable();
            $table->string('computer_name')->nullable();
            $table->macAddress('wifi_mac')->nullable();
            $table->macAddress('lan_mac')->nullable();
            $table->string('nomor_inventaris')->nullable();
            $table->enum('kondisi',['BAIK','KURANG BAIK','RUSAK']);
            $table->year('tahun_perolehan')->nullable();
            $table->string('keterangan');
            $table->bigInteger('created_by')->unsigned();
            $table->timestamps();
            $table->softDeletes();

            $table->foreign('device_type_id')->references('id')->on('device_types');
            $table->foreign('ram_type_id')->references('id')->on('ram_types');
            $table->foreign('unit_id')->references('id')->on('units');
            $table->foreign('operating_system_id')->references('id')->on('operating_systems');
            $table->foreign('created_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('goods');
    }
}
