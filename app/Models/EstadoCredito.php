<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCredito extends Model
{
    use HasFactory;

    protected $table = "estado_creditos";
    protected $fillable = [
        'nombre',
    ];
}
