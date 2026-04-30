<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PLI extends Model
{
    //

    protected $table = 'plis';
    
protected $fillable = [
    'code',
    'name',
    'classification',
    'accredited'
];


public function coverages()
{
    return $this->hasMany(\App\Models\Coverage::class, 'ded_code', 'code');
}
}
