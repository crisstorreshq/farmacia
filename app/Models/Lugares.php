<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Lugares extends Model
{
    protected $table = 'SER_Lugares';

	// protected $primaryKey = 'PAC_PAC_Numero';

    public $timestamps = false;

    // protected $keyType= 'float';

    protected $hidden = [
        'SER_LUG_TimeStamp', 'SER_LUG_SubCodig', 'SER_LUG_TipoLugar', 'SER_SER_Ambito', 'SER_REC_Descripcio', 'GrabaPYXIS'
    ];

    protected $fillable = [
        'SER_LUG_Codigo', 'SER_LUG_Descripcio', 'SER_LUG_Ubicacion', 'SER_LUG_Vigencia'
    ];

}