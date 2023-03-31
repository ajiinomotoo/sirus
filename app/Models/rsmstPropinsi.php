<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstPropinsi extends Model
{
    use HasFactory;
    protected $table = 'rsmst_propinsis';
    protected $primaryKey = 'prop_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function kabupaten(): HasMany
    {
        return $this->hasMany(rsmstKabupaten::class);
    }
    public function pasien(): HasMany
    {
        return $this->hasMany(rsmstPasien::class);
    }
}
