<?php

namespace Database\Seeders;

use Carbon\Carbon;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProvinciaTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $now = Carbon::now()->toDateTimeString();

        $provincias = [
            array('nombre' => 'AZUAY', 'codigo' => '01', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'BOLIVAR', 'codigo' => '02', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'CAÑAR', 'codigo' => '03', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'CARCHI', 'codigo' => '04', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'COTOPAXI', 'codigo' => '05', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'CHIMBORAZO', 'codigo' => '06', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'EL ORO', 'codigo' => '07', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'ESMERALDAS', 'codigo' => '08', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'GUAYAS', 'codigo' => '09', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'IMBABURA', 'codigo' => '10', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'LOJA', 'codigo' => '11', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'LOS RIOS', 'codigo' => '12', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'MANABI', 'codigo' => '13', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'MORONA SANTIAGO', 'codigo' => '14', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'NAPO', 'codigo' => '15', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'PASTAZA', 'codigo' => '16', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'PICHINCHA', 'codigo' => '17', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'TUNGURAHUA', 'codigo' => '18', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'ZAMORA CHINCHIPE', 'codigo' => '19', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'GALAPAGOS', 'codigo' => '20', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'SUCUMBIOS', 'codigo' => '21', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'ORELLANA', 'codigo' => '22', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'SANTO DOMINGO DE LOS TSACHILAS', 'codigo' => '23', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'SANTA ELENA', 'codigo' => '24', 'created_at' => $now, 'updated_at' => $now),
            array('nombre' => 'ZONAS NO DELIMITADAS', 'codigo' => '90', 'created_at' => $now, 'updated_at' => $now),
        ];
        DB::table('provincias')->insert($provincias);
    }
}
