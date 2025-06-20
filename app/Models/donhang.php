<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\nguoidung;

class donhang extends Model
{
    protected $table = 'donhang';
    public $timestamps = false;
    protected $primaryKey = 'iddonhang';        
    public $incrementing = true;                 
    protected $keyType = 'int';

    public function nguoidung()
    {
        return $this->belongsTo(nguoidung::class, 'idnguoidung', 'idnguoidung');
    }
}
