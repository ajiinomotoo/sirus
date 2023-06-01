<?php

namespace App\Models;

use App\Http\Controllers\RsmstDoctorController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstPoli extends Model
{
    use HasFactory;
    protected $table = 'rsmst_polis';
    protected $primaryKey = 'poli_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function doctor(): HasMany
    {
        return $this->hasMany(rsmstDoctor::class);
    }
    public function rj(): HasMany
    {
        return $this->hasMany(rstxnRjhdrs::class);
    }
}
