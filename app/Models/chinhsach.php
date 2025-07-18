<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class chinhsach extends Model
{
    protected $table = 'chinhsach';
    public $timestamps = false;
    protected $primaryKey = 'idchinhsach';        
    public $incrementing = true;

    public function loaichinhsach()
    {
        return $this->belongsTo(loaichinhsach::class, 'idloaichinhsach', 'idloaichinhsach');
    }
}
