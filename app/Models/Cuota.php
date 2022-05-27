<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cuota extends Model
{
    use HasFactory;

    protected $table = "cuotas";
    protected $fillable = [
        'creditoid',
        'estadocuotaid',
        'numerocuota',
        'saldoinsoluto',
        'valorcuota',
        'fechavencimientocuota',
        'estado_activo',
    ];

    public function estadoCuotas()
    {
        return $this->belongsTo(EstadoCuota::class, 'estadocuotaid');
    }

    public function creditos()
    {
        return $this->belongsTo(Credito::class, 'creditoid');
    }
}
