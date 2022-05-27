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
        'estado_activo',
    ];
}
