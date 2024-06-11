<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Profesional extends Model
{
    protected $table = 'SER_Profesiona';

    public $timestamps = false;

    protected $primaryKey = 'SER_PRO_Rut';

    protected $keyType= 'string';

    protected $fillable = [
        'SER_PRO_Rut', 'SER_PRO_Tipo', 'SER_PRO_ApellPater', 'SER_PRO_ApellMater', 'SER_PRO_Nombres', 'SER_PRO_Estado', 'SER_PRO_Procedencia', 'Farmacia', 'SER_PRO_Agenda'
    ];
}