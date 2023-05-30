<?php

namespace App\Models;

use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Customer extends Model
{
    use HasFactory, HasApiTokens;



    protected $fillable=[
        'firstname',
        'lastname',
        'email',
        'password',

    ];

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
     }

}
