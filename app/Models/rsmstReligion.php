<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstReligion extends Model
{
    use HasFactory;
    protected $table = 'rsmst_religions';
    protected $primaryKey = 'rel_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
