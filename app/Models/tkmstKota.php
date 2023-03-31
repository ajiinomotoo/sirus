<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class tkmstKota extends Model
{
    use HasFactory;
    protected $table = 'tkmst_kotas';
    protected $primaryKey = 'kota_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function prov(): BelongsTo
    {
        return $this->belongsTo(tkmstProv::class, 'prov_id');
    }
}
