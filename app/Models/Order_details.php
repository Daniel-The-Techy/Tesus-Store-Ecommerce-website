<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order_details extends Model
{
    use HasFactory;


    protected $fillable=[
        'customers_id',
        'firstName',
        'lastName',
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
}
