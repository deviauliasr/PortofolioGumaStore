<?php

namespace App;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    public function user()
    {
        return $this->belongsTo('App\User','user_id','id');
    }

    public function keranjang()
    {
        return $this->hasMany('App\Keranjang','checkout_id','id');
    }

    protected $fillable = [
        'bukti_transfer',
    ];
}