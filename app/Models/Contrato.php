<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Contrato extends Model
{
    use HasFactory;

    protected $table = "contratos";
    protected $fillable = [
        'numcontrato',
        'tipocontrato',
        'valorgarantia',
        'fechainicio',
        'fechafin',
        'pathidentificacion',
        'pathplanilla',
        'pathfacturavehiculo',
        'pathfacturacontrato',
        'pathtablaamortizacion',
        'pathpagare',
        'creditoid',
        'estado_activo',
    ];

    //relacion con credito
    public function credito() {
        return $this->belongsTo(Credito::class, 'creditoid');
    }
}
