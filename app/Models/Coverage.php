<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Coverage extends Model
{
   protected $fillable = [
    'region',
    'prov_id',
    'div_code',
    'ded_code',
    'added_by',
    'date_time_added'
];
}