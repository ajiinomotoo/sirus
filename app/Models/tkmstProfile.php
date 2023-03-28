<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class tkmstProfile extends Model
{
    use HasFactory;
    protected $table = 'tkmst_profiles';
    protected $primaryKey = 'prof_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
