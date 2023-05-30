<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Wishlist;

class WishlistController extends Controller
{
    

    public function store(Request $request){

        $product_id=$request->input('Product_id');
        return $request->user()->wishlist()->create([
            'Products_id'=>$product_id
        ]);
    }

        public function getProduct(Request $request){
          
            return Product::join('Wishlists', 'products.id', '=', 'Wishlists.Products_id')
           ->select('Products.*')
           ->where('customer_id', $request->user()->id)
            ->get();
          
        }


        public function deleteWishlist(Request $request, $id){
            return Wishlist::where('customer_id', $request->user()->id)
            ->where('Products_id', $id)
            ->delete();
        }
    
    
        
    
}

