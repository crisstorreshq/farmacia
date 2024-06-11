<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use OwenIt\Auditing\Contracts\Auditable;

class PrestacionesUMT extends Model implements Auditable
{
    use \OwenIt\Auditing\Auditable;

    protected $table = 'BD_PPV.dbo.Prestaciones_UMT';

    public $timestamps = false;

    protected $fillable = [
        'prestacion_id', 'unidad_id', 'cantidad', 'beneficiario', 'fecha_prestacion', 'fecha_update', 'fecha_digitacion', 'created_by', 'updated_by', 'deleted_by', 'vigente'
    ];

    public function prestacion()
    {
        return $this->belongsTo(PrestaUMT::class);
    }

    public function unidad()
    {
        return $this->belongsTo(UnidadUMT::class);
    }

    public function usuario()
    {
        return $this->belongsTo(Usuarios::class, 'created_by', 'Segu_Usr_Cuenta');
    }
}