<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Reporte extends Model
{
    use HasFactory;

    protected $table = "reportes";
    protected $fillable = [
        'creditoid',
        'estadocuotaid',
        'plate',
        'date',
        'periodtype',
        'period',
        'depreciation_real',
        'depreciation_expected',
        'fechavencimiento',
        'saldoinsoluto',
        'odometer',
        'avg_odometer_by_day',
    ];
}
