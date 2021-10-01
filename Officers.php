<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Officers extends Model
{
    protected $table = 'officers';
    public $timestamps = false;

    protected $fillable = ['nama_petugas' ,  'username' , 'password' , 'level'];
}
