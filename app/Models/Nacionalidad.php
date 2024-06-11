<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use DateTime;

class Nacionalidad extends Model
{
    protected $table = 'TAB_Nacionalidad';

	protected $primaryKey = 'NAC_Ide';

    public $timestamps = false;

    protected $hidden = [
        "NAC_Vigente", "DEIS_2018", "NAC_Ide"
    ];
}
