<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class nguyenlieu extends Model
{
    protected $table = 'nguyenlieu';
    public $timestamps = false;
    protected $primaryKey = 'idnguyenlieu';        
    public $incrementing = true;                 
    protected $keyType = 'int';
}
