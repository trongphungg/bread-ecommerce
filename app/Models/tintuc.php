<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\Models\loaitintuc;

class tintuc extends Model
{
    protected $table = 'tintuc';
    public $timestamps = false;
    public function loaitintuc()
    {
        return $this->belongsTo(loaitintuc::class, 'idloaitintuc', 'idloaitintuc');
    }
}
