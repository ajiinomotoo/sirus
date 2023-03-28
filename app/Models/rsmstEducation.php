<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstEducation extends Model
{
    use HasFactory;
    protected $table = 'rsmst_educations';
    protected $primaryKey = 'edu_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
