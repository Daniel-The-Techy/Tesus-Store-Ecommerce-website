<?php

namespace App\Models;

use App\Models\Customer;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Wishlist extends Model
{
    use HasFactory;

   // public $table='Wishlists';


    protected $fillable=[
        'Products_id'
    ];

    public function user(){
       return $this->belongsTo(Customer::class);
    }

  
}
