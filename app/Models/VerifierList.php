<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class VerifierList extends Model
{
    use HasFactory;

    protected $table = 'verifier_lists';

    protected $fillable = [
        'fullname',
        'username',
        'password',
        'region',
        'verifier_email',
        'deped_email',
        'status',
    ];

    protected $hidden = [
        'password',
    ];

    public function assignments()
    {
        return $this->hasMany(Verifier::class, 'verifier_id');
    }
}