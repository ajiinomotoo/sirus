<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstMstDiag extends Model
{
    use HasFactory;
    protected $table = 'rsmst_mstdiags';
    protected $primaryKey = 'diag_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
