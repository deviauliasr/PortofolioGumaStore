<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Keranjang extends Model
{
    public function barang()
    {
        return $this->belongsTo('App\Barang','barang_id','id');
    }

    public function checkout()
    {
        return $this->belongsTo('App\Checkout','checkout_id','id');
    }
}