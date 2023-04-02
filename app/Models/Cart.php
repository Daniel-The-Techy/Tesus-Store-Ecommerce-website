<?php

namespace App\Models;


use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Cart extends Model
{
    use HasFactory;

    public $table='Carts';

    protected $fillable=[
        'user_id',
        'Product_id',
        'quantity',
        'Session_id'
    ];


    public function user(){
        $this->belongsTo(User::class);
    }
}
