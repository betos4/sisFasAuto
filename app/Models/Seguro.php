<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Seguro extends Model
{
    use HasFactory;

    protected $table = "seguros";
    protected $fillable = [
        'nombre',
        'numseguro',
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
