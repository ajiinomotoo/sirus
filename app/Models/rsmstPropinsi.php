<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstPropinsi extends Model
{
    use HasFactory;
    protected $table = 'rsmst_propinsis';
    protected $primaryKey = 'prop_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
