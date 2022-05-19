<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class RolUserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();
        
        $rolesMenu = [
            array('rol_id' => '1', 'user_id' => '1', 'created_at' => $now, 'updated_at' => $now),
        ];
        
        DB::table('roles_user')->insert($rolesMenu);
    }
}
