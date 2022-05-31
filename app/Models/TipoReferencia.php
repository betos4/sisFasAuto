<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class TipoReferencia extends Model
{
    use HasFactory;

    protected $table = 'tipo_referencias';
    protected $fillable = [
        'nombre',
        'estado_activo',
    ];

    //relacion con referencias
    public function referencias() {
        return $this->hasMany(Referencia::class, 'tiporeferenciaid');
    }
}
