<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Barang extends Model
{
    public function keranjang()
    {
        return $this->hasMany('App\Keranjang','barang_id','id');
    }
}