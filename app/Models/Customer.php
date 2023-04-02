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
        'phone_Number',
        'company',
        'Address_1',
        'Address_2',
        'city',
        'Postal_Code',
        'country',
        'State',
    ];

    public function wishlist(){
        return $this->hasMany(Wishlist::class);
     }
}
