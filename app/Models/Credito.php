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

    public function estadoCredito()
    {
        return $this->belongsTo(EstadoCredito::class, 'estadocreditoid');
    }
}
