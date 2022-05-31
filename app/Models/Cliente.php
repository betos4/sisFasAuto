<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cliente extends Model
{
    use HasFactory;

    protected $table = "clientes";
    protected $fillable = [
        'rut',
        'nombre',
        'apaterno',
        'amaterno',
        'email',
        'telefono',
        'celular',
        'estadocivilid',
        'estado_activo',
    ];

    //relacion con estado civil
    public function estadoCivil() {
        return $this->belongsTo(EstadoCivil::class, 'estadocivilid');
    }

    //relacion con direcciones
    public function direcciones() {
        return $this->hasMany(Direccion::class, 'clienteid');
    }

    //relacioni con referencias
    public function referencias() {
        return $this->hasMany(Referencia::class, 'clienteid');
    }
}
