<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Foundation\Auth\User as Authenticatable;

class nguoidung extends Authenticatable
{
    protected $table = 'nguoidung';
    public $timestamps = false;
    protected $fillable = [
        'email', 'password', 'tennguoidung', 'role','ngaysinh','diachi','gioitinh','sodienthoai','facebook_id','google_id'
    ];
    protected $primaryKey = 'idnguoidung';        
    public $incrementing = true;                 
    protected $keyType = 'int'; 
}
