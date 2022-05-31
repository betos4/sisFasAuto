<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCivil extends Model
{
    use HasFactory;

    protected $table = 'estado_civiles';
    protected $fillable = [
        'nombre',
        'estado_activo',
    ];

    //relacion con clientes
    public function clientes() {
        return $this->hasMany(Cliente::class, 'estadocivilid');
    }
}
