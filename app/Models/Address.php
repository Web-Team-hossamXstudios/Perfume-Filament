<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Address extends Model
{
    use HasFactory ;
    protected $fillable = [
        'client_id',
        'type',
        'city',
        'area',
        'buliding',
        'appartment',
        'floor',
        'street',
        'additional_directions',
    ];

    public function client( ){
        return $this->belongsTo(Client::class);
    }

    public function order(){
        return $this->hasMany(Order::class);
    }
}
