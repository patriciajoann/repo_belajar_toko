<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DetailOrders extends Model
{
    protected $table = 'detail_orders';
    public $timestamps = false;

    protected $fillable = ['id_transaksi' , 'id_produk'  , 'qty' , 'subtotal'];
}
