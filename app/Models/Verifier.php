<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Verifier extends Model
{
    use HasFactory;

    protected $table = 'verifiers';

    protected $fillable = [
        'region',
        'province',
        'div_code',
        'div_iuid',
        'verifier_id',
        'is_iu',
        'added_by',
    ];

    /*
    |--------------------------------------------------------------------------
    | RELATIONSHIP
    |--------------------------------------------------------------------------
    */

    // belongs to VerifierList (user)
    public function user()
    {
        return $this->belongsTo(VerifierList::class, 'verifier_id');
    }

    // optional: link to Region table
    public function regionInfo()
    {
        return $this->belongsTo(Region::class, 'region', 'REGCODE');
    }

    // optional: link to Province table
    public function provinceInfo()
    {
        return $this->belongsTo(Province::class, 'province', 'ProvID');
    }

    // optional: link to Division table
    public function divisionInfo()
    {
        return $this->belongsTo(Division::class, 'div_code', 'DivCode');
    }
}