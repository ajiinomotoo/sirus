<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class rsmstPasien extends Model
{
    use HasFactory;
    protected $table = 'rsmst_pasiens';
    protected $primaryKey = 'reg_no';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];

    public function rel(): BelongsTo
    {
        return $this->belongsTo(rsmstReligion::class, 'rel_id');
    }
    public function edu(): BelongsTo
    {
        return $this->belongsTo(rsmstEducation::class, 'edu_id');
    }
    public function job(): BelongsTo
    {
        return $this->belongsTo(rsmstJob::class, 'job_id');
    }
    public function desa(): BelongsTo
    {
        return $this->belongsTo(rsmstDesa::class, 'des_id');
    }
    public function kec(): BelongsTo
    {
        return $this->belongsTo(rsmstKecamatan::class, 'kec_id');
    }
    public function kab(): BelongsTo
    {
        return $this->belongsTo(rsmstKabupaten::class, 'kab_id');
    }
    public function prop(): BelongsTo
    {
        return $this->belongsTo(rsmstPropinsi::class, 'prop_id');
    }
}
