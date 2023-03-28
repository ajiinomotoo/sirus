<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstParameter extends Model
{
    use HasFactory;
    protected $table = 'rsmst_parameters';
    protected $primaryKey = 'par_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
