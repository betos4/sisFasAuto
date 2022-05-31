<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Vehiculo extends Model
{
    use HasFactory;

    protected $table = "vehiculos";
    protected $fillable = [
        'tipouso',
        'gps',
        'marca',
        'modelo',
        'color',
        'vin',
        'motor',
        'chasis',
        'anio',
        'placa',
        'creditoid',
        'estado_activo',
    ];

    //relacion con dispositivo
    public function dispositivos() {
        return $this->hasMany(Dispositivo::class, 'vehiculoid');
    }

    //relacion con seguros
    public function seguros() {
        return $this->hasMany(Seguro::class, 'vehiculoid');
    }
}
