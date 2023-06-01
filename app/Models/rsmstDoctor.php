<?php

namespace App\Models;

use App\Http\Controllers\RsmstPoliController;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class rsmstDoctor extends Model
{
    use HasFactory;
    protected $table = 'rsmst_doctors';
    protected $primaryKey = 'dr_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function poli(): BelongsTo
    {
        return $this->belongsTo(rsmstPoli::class, 'poli_id');
    }

    public function rj(): HasMany
    {
        return $this->hasMany(rstxnRjhdrs::class);
    }
}
