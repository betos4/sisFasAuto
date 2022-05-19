<?php

namespace Database\Seeders;

use App\Models\Rol;
use Illuminate\Database\Seeder;

class RolTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Rol::create([
            'name_rol' => 'SUPERADMINISTRADOR',
            'description_rol' => 'ADMINISTRADOR DEL SISTEMA',
            'is_superadministrator_rol' => 1,
        ]);
    }
}
