<?php

namespace App\Http\Controllers\Api;

use App\Models\Cart;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\CartResource;
use Facades\App\Service\CartService;
use App\Service\CartService as ServiceCartService;

class CartController extends Controller
{
    
    public function index(Request $request){
        $User_id=$request->input('getid');
       return CartResource::collection(CartService::getAllCart($User_id));
    }

    public function InsertCart(Request $request){
        $id=$request->input('id');
        $User_id=$request->input('Authid');
        $quantity=$request->input('quantity');
        $Cart=CartService::addToCart($id, $User_id, $quantity);
        
        return $Cart;
    }

    public function deleteCart($id){
        $deletedCart=CartService::removeCart($id);
        return $deletedCart;
    }

    public function increaseQuantity($id, Request $request){
        $quantity=$request->input('quantity');
        return CartService::updateQuantity($id, $quantity);
    }

   
}
