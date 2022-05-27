<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EstadoCuota extends Model
{
    use HasFactory;

    protected $table = "estado_cuotas";
    protected $fillable = [
        'nombre',
    ];
}
