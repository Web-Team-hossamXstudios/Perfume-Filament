<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Cart;


class Client extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory,InteractsWithMedia , Notifiable;

    protected $fillable = [
        'name',
        'email',
        'phone',
        'password',
        'gender',
        'birthdate',
    ];

    protected $hidden = [
        'password',
        'remember_token',
    ];

    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];



    public function address( ){
        return $this->hasMany(Address::class);
    }

    public function orders( ){
        return $this->hasMany(Order::class);
    }

    public function cart( ){
        return $this->hasOne(Cart::class);
    }

    public function reviews( ){
        return $this->hasMany(Review::class);
    }

    public function favourites( ){
        return $this->hasMany(Favourite::class);
    }

    
    public function getJWTIdentifier() {
        return $this->getKey();
    }

    
    public function getJWTCustomClaims() {
        return [];
    }
    

    public function generateCode() {
        
        $this->timestamps = false;
        $this->code = rand(1000,9999);
        $this->expire_at = now()->addMinute(15);
        $this->save();
        
    }

    public function destoryCode() {
        
        $this->timestamps = false;
        $this->code = null;
        $this->expire_at = null;
        $this->save();
        
    }


}
