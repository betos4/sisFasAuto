<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class MenuRolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        
        $menusRol = [
            array('rol_id' => '1', 'menu_id' => '1', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '2', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '4', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '3', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '5', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '6', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '7', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '8', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '9', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '10', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '11', 'created_at' => $now, 'updated_at' => $now),
            array('rol_id' => '1', 'menu_id' => '12', 'created_at' => $now, 'updated_at' => $now),
        ];
        DB::table('menus_rol')->insert($menusRol);
    }
}
