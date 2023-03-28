<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class rsmstEntryType extends Model
{
    use HasFactory;
    protected $table = 'rsmst_entrytypes';
    protected $primaryKey = 'entry_id';
    public $incrementing = false;
    protected $keyType = 'string';
    protected $guarded = [''];
}
