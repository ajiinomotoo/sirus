<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstKecamatan extends Model
{
    use HasFactory;
    protected $table = 'rsmst_kecamatans';
    protected $primaryKey = 'kec_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function kab(): BelongsTo
    {
        return $this->belongsTo(rsmstKabupaten::class, 'kab_id');
    }

    public function desa(): HasMany
    {
        return $this->hasMany(rsmstDesa::class);
    }
    public function pasien(): HasMany
    {
        return $this->hasMany(rsmstPasien::class);
    }
}
