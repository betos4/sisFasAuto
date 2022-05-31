<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Dispositivo extends Model
{
    use HasFactory;

    protected $table = "dispositivos";
    protected $fillable = [
        'deviceid',
        'datetimeReported',
        'heading',
        'installationDate',
        'lat',
        'lng',
        'odometer',
        'speed',
        'stopLat',
        'year',
        'lastIntervalInfo',
        'lastDateReported',
        'avg_odometer_by_day',
        'proveedor',
        'fechainicio',
        'fechafin',
        'vehiculoid',
        'estado_activo',
    ];

    //relacion con vehiculo
    public function vehiculo() {
        return $this->belongsTo(Vehiculo::class, 'vehiculoid');
    }
}
