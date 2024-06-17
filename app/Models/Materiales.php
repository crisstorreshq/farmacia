<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DB;

class Materiales extends Model
{
    protected $table = 'BD_ABASTECIMIENTO.dbo.TB_MATERIALES';

    public $timestamps = false;

    protected $fillable = [
        'FLD_MATCODIGO', 'FLD_MATNOMBRE', 'FLD_GMACODIGO', 'Vigente'
    ];

    public static function getFilteredMaterials()
    {
        return DB::table('BD_ABASTECIMIENTO.dbo.TB_MATERIALES')
            ->select(DB::raw('RTRIM(LTRIM(FLD_MATCODIGO)) AS id'), DB::raw('RTRIM(LTRIM(FLD_MATNOMBRE)) AS name'))
            ->where('Vigente', 1)
            ->where('FLD_GMACODIGO', 'FAR')
            ->orderBy('FLD_MATCODIGO', 'asc')
            ->get();
    }
}