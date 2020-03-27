<?php

use Illuminate\Database\Seeder;
use App\User;
use App\level;
use App\unit;
use App\category;
use App\ram_type;
use App\operating_system;
use App\device_type;
use App\goods;
use \Colors\RandomColor;

use Faker\Factory as Faker;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        /** SEEDER LEVEL */
        $ket_level = ["ADMIN","OPERATOR","EKSEKUTIF"];;
        for($i=0;$i<3;$i++){
            level::create([
                'keterangan'=> $ket_level[$i]
            ]);
        }

        /**SEEDER UNITS */
        $unit_alias = ["BETA","BEKA","KSSL"];
        $unit_ket = ["BENTAYAN","BETUNG KRAWO","KANTOR PERWAKILAN SUMATERA SELATAN"];
        for($i=0;$i<3;$i++){
            unit::create([
                'alias'=> $unit_alias[$i],
                'keterangan'=> $unit_ket[$i],
                'color'=>RandomColor::one(array(
                    'luminosity' => 'light'
                ))
            ]);
        }

        /**SEEDER USERS */
        $faker = Faker::create('id_ID');
        for($i=0;$i<5;$i++){
            User::create([
                'name' => $faker->name,
                'email' => $faker->freeEmail,
                'level_id' => $faker->numberBetween($min=1,$max=3),
                'unit_id' => $faker->numberBetween($min=1,$max=3),
                'password' => bcrypt("123456789")
            ]);
        }

        /** SEEDER CATEGORY */
        $category_name = ["PERANGKAT JARINGAN","PERSONAL COMPUTER","LAPTOP","PRINTER","LAIN-LAIN"];
        for($i=0;$i<5;$i++){
            category::create([
                'category_name' => $category_name[$i]
            ]);
        }

        /**SEEDER RAM TYPE */
        $ram_type = ["DDR1","DDR2","DDR3","DDR4","DDR1 SODIMM (LAPTOP)","DDR2 SODIMM (LAPTOP)","DDR3 SODIMM (LAPTOP)","DDR4 SODIMM (LAPTOP)","LAIN-LAIN"];
        foreach($ram_type as $r){
            ram_type::create([
                'tipe_ram' => $r
            ]);
        }

        /** SEEDER OPERATING SYSTEM */
        $operatingsystem = ["WINDOWS XP","WINDOWS 7","WINDOWS 8","WINDOWS 8.1","WINDOWS 10","Windows Server 2008","Windows Server 2008 R2","Windows Server 2012","Windows Server 2012 R2","Windows Server 2016","Windows Server 2019","MAC OS","LINUX","LAIN-LAIN"];
        foreach($operatingsystem as $os){
            operating_system::create([
                'os_name' => $os
            ]);
        }

        /** SEEDER TIPE PERANGKAT */
        $perangkatjaringan = ["Router","Managed Switch 24-Port","Switch","Hub"];
        $pjkodeinvent = ["RTR","MSWTCH24","SWTCH","HUB"];
        for($i=0;$i<4;$i++){
            device_type::create([
                'nama_perangkat' => $perangkatjaringan[$i],
                'category_id' => 1,
                'kode_inventaris' => $pjkodeinvent[$i]
            ]);
        }

        //** SEEDER GOODS */
        $kondisi = ["BAIK","KURANG BAIK","RUSAK"];
        for($i=0;$i<100;$i++){
            $tambahinventaris = goods::create([
                'device_type_id' => $faker->numberBetween($min=1,$max=4),
                'nama_barang' => $faker->name,
                'serial_number' => $faker->numberBetween($min=1000000000,$max=9999999999),
                'processor' => "PROCESSOR",
                'storage_size' => $faker->numberBetween($min=500,$max=5000),
                'ram_size' => $faker->numberBetween($min=1,$max=16),
                'ram_type_id' => $faker->numberBetween($min=1,$max=9),
                'storage_size' => $faker->numberBetween($min=500,$max=5000),
                'unit_id' => $faker->numberBetween($min=1,$max=3),
                'operating_system_id' => $faker->numberBetween($min=1,$max=14),
                'computer_name' => $faker->userName,
                'wifi_mac' => $faker->macAddress,
                'lan_mac' => $faker->macAddress,
                'kondisi' => $kondisi[$faker->numberBetween($min=0,$max=2)],
                'tahun_perolehan' => $faker->numberBetween($min=2010,$max=2020),
                'keterangan' => "INI KETERANGAN",
                'created_by' => $faker->numberBetween($min=1,$max=5)
            ]);
            $device_code = device_type::find($tambahinventaris->device_type_id);
            $generate = goods::find($tambahinventaris->id);
            $generate->nomor_inventaris="RJ/PTPN7/INV/".$device_code->kode_inventaris."/".$tambahinventaris->id."/".$tambahinventaris->tahun_perolehan;
            $generate->save();
        }
    }
}
