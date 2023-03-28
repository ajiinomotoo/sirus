<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rsmstKecamatan extends Model
{
    use HasFactory;
    protected $table = 'rsmst_kecamatans';
    protected $primaryKey = 'kec_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
