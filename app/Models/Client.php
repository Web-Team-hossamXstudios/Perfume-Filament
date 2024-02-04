<?php

namespace App\Models;

use Spatie\MediaLibrary\HasMedia;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\InteractsWithMedia;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Tymon\JWTAuth\Contracts\JWTSubject;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Models\Cart;


class Client extends Authenticatable implements JWTSubject, HasMedia
{
    use HasFactory,InteractsWithMedia;

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
    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier() {
        return $this->getKey();
    }
    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims() {
        return [];
    }
}
