<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstOut extends Model
{
    use HasFactory;
    protected $table = 'rsmst_outs';
    protected $primaryKey = 'out_no';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
