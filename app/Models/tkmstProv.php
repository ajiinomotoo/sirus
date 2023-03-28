<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class tkmstProv extends Model
{
    use HasFactory;
    protected $table = 'tkmst_provs';
    protected $primaryKey = 'prov_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function kota(): HasMany
    {
        return $this->hasMany(tkmstKota::class);
    }
}
