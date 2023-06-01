<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rstxnRjhdrs extends Model
{
    use HasFactory;
    protected $table = 'rstxn_rjhdrs';
    protected $primaryKey = 'rj_no';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function pasien(): BelongsTo
    {
        return $this->belongsTo(rsmstPasien::class, 'reg_no');
    }
    public function poli(): BelongsTo
    {
        return $this->belongsTo(rsmstPoli::class, 'poli_id');
    }
    public function doctor(): BelongsTo
    {
        return $this->belongsTo(rsmstDoctor::class, 'dr_id');
    }
    public function klaim(): BelongsTo
    {
        return $this->belongsTo(rsmstKlaimType::class, 'klaim_id');
    }
}
