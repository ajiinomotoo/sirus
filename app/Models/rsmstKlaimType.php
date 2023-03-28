<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstKlaimType extends Model
{
    use HasFactory;
    protected $table = 'rsmst_klaimtypes';
    protected $primaryKey = 'klaim_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
