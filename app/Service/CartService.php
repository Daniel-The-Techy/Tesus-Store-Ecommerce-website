<?php 

namespace App\Service;

use App\Http\Controllers\Api\UserController;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Cookie;


class CartService{

    public $quantity=1;
    private $token;


    public function __construct()
    {
      $this->token=Cookie::get('unique-token');
    }

    public function addToCart($id, $User_id, $quantity){

         if(!$this->check($id, $User_id)){
             $Auth=$User_id ?? 0;
             $this->quantity=$quantity ?? 1;

              $Cart=Cart::create([
                 'user_id'=> $Auth,
                 'Product_id'=>$id,
                 'quantity'=>$this->quantity,
                 'Session_id'=>$this->token
                ]);


                  return back()->with('status', 'Product added to Cart');
          }else{
    
            $this->updateQuantity($id, $quantity);
          }
      }

      public function check($id, $User_id){
        if($User_id !==null){
           return Cart::where('Product_id', '=', $id)
             ->where('id', $User_id)->first();
        }else{
          return Cart::where('Product_id', '=', $id)
              ->where('Session_id', $this->token)->first();
        }
    }

    public function updateQuantity($id, $quantity){

      $quantityCount=$quantity ?? 1;

         $cartQuantity=Cart::where('Product_id', $id)
         ->where('Session_id', $this->token)
         ->first();

            if($cartQuantity){
              $cartQuantity->quantity+=$quantityCount;
              $cartQuantity->save();
            }
         
        
      }



      
      public function removeCart($id){
        return Cart::where('Session_id', $this->token)
        ->where('product_id', $id)->delete();
      }


      public function getAllCart(){
             return Product::join('Carts', 'products.id', '=', 'carts.Product_id')
                ->select('Products.*', 'carts.quantity')
                 ->where('Session_id', $this->token)
                 ->where('carts.user_id', '=', 0)
                 ->get();
            
         }


   
}