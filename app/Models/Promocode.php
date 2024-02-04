<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Promocode extends Model
{
    use HasFactory;
    protected $guarded = [];
    protected $fillable = ['code', 'exp'];



    public function orders( ){
        return $this->hasMany(Order::class);
    }
}
