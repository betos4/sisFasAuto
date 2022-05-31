<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Referencia extends Model
{
    use HasFactory;

    protected $table = 'referencias';
    protected $fillable = [
        'rut',
        'nombre',
        'email',
        'telefono',
        'celular',
        'clienteid',
        'tiporeferenciaid',
        'estado_activo',
    ];

    //relacion con tipo referencia
    public function tipoReferencia() {
        return $this->belongsTo(TipoReferencia::class, 'tiporeferenciaid');
    }

    //relacion con cliente
    public function cliente() {
        return $this->belongsTo(Cliente::class, 'clienteid');
    }
}
