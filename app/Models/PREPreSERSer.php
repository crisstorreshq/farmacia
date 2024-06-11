<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PREPreSERSer extends Model
{
    protected $table = 'NET_PREPreSERSer';

	protected $primaryKey = 'SER_SER_Codigo';

    public $timestamps = false;

    protected $keyType= 'string';

    protected $fillable = [
        'PRE_PRE_Codigo', 'SER_SER_Codigo', 'REL_PRE_SER_Cantidad', 'REL_PRE_SER_Cr'
    ];

    protected $hidden = [
        'REL_PRE_Ranking', 'REL_PRE_Fijo'
    ];
}