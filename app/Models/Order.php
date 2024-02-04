<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;
    protected $guarded = [];

    public function client( ){
        return $this->belongsTo(Client::class);
    }

    public function promocode( ){
        return $this->belongsTo(Promocode::class);
    }

    public function transaction( ){
        return $this->belongsTo(Transaction::class);
    }

    public function items( ){
        return $this->hasMany(OrderItem::class);
    }
    public function address(){
        return $this->belongsTo(Address::class);
    }
    public function cart(){
        return $this->hasOne(Cart::class);
    }
    public function cartitem(){
        return $this->hasMany(Cart::class);
    }

}
