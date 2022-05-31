<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Credito extends Model
{
    use HasFactory;

    protected $table = "creditos";
    protected $guarded = ['id'];
    protected $primaryKey = 'id';

    //relacion estado credito
    public function estadoCredito()
    {
        return $this->belongsTo(EstadoCredito::class, 'estadocreditoid');
    }

    //relacion con cliente
    public function cliente()
    {
        return $this->belongsTo(Cliente::class, 'clienteid');
    }

    //relacion con contratos
    public function contratos() {
        return $this->hasMany(Contrato::class, 'creditoid');
    }
}
