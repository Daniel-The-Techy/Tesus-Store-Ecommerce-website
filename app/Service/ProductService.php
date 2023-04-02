<?php 

namespace  App\Service;

use App\Models\Product;
use App\Models\category;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Cookie;

class ProductService{


    public function getProducts(){
        $this->setToken();
       $value=Cache::remember('products', 1440, function () {
             return Product::paginate(6);
       });
              return $value;
    }


    public function setToken(){
        // $token=Session::getId();
         $token=Str::random(30);
         //$token=Cookie::get('PHPSESSID');
             if(!Cookie::has('unique-token')){
              Cookie::queue(cookie('unique-token', $token, 1440));
             }
      
             }

             public function getCategory(){
                return category::get();
              }

              public function SearchProduct($name){
                return Product::where('title', 'like',' %'.$name.'%')
                ->orWhere('description', 'like',  '%'.$name.'%')
                ->orWhere('title', 'like', '%'.$name.'%')
                ->orWhere('price', 'like', '%'.$name.'%')
                ->get();
              }

            
}


?>