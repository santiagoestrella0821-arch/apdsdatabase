<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Province extends Model
{
    //
       
    protected $fillable = [
        'ProvID',
        'Province',
        'ProvCode',
        'Region'
    ];
}
