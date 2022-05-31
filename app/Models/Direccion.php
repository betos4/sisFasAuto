<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Direccion extends Model
{
    use HasFactory;

    protected $table = 'direcciones';
    protected $fillable = [
        'direccion',
        'sector',
        'tipodireccion',
        'cantonid',
        'clienteid',
        'estado_activo',
    ];

    //relacion con clientes
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'estadocivilid');
    }
}
