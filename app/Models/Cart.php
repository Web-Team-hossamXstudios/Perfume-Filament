<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    use HasFactory;
    protected $fillable = [
        'client_id',
        'total_price',
    ];

    public function client( ){
        return $this->belongsTo(Client::class);
    }

    public function cart_items( ){
        return $this->hasMany(CartItem::class);
    }
    public function order(){
        return $this->belongsTo(Order::class);
    }
}
