<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstDesa extends Model
{
    use HasFactory;
    protected $table = 'rsmst_desas';
    protected $primaryKey = 'des_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function kec(): BelongsTo
    {
        return $this->belongsTo(rsmstKecamatan::class, 'kec_id');
    }

    public function pasien(): HasMany
    {
        return $this->hasMany(rsmstPasien::class);
    }
}
