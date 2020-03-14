<?php

use Illuminate\Database\Seeder;
use App\User;
use App\level;
use App\unit;
use App\category;
use App\ram_type;
use App\operating_system;
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
                'keterangan'=> $unit_ket[$i]
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
    }
}
