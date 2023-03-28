<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstJob extends Model
{
    use HasFactory;
    protected $table = 'rsmst_jobs';
    protected $primaryKey = 'job_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
