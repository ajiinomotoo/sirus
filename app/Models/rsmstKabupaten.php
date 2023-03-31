<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstKabupaten extends Model
{
    use HasFactory;
    protected $table = 'rsmst_kabupatens';
    protected $primaryKey = 'kab_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function prop(): BelongsTo
    {
        return $this->belongsTo(rsmstPropinsi::class, 'prop_id');
    }
    public function kecamatan(): HasMany
    {
        return $this->hasMany(rsmstKecamatan::class);
    }
    public function pasien(): HasMany
    {
        return $this->hasMany(rsmstPasien::class);
    }
}
