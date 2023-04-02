<?php

namespace App\Http\Controllers\Api;

use App\Models\Product;
use App\Models\category;
use App\Service\CartService;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Resources\ProductResource;
use Facades\App\Service\ProductService;

class ProductController extends Controller
{
    
    public function index(){
        return ProductResource::collection(ProductService::getProducts());
    }

    public function Category(){
        $category=ProductService::getCategory();
  
        $response=[
           'category'=>$category
        ];
  
        return response($response, 201);
      }

      public function show($name){
        return ProductService::Searchproduct($name);
    }

    public function getCategory($id){
        $data=category::find($id)->product;
        
        $response=[
            'data'=>$data
        ];

        return response($response, 200);
    }

    public function getProductBySlug($slug){
       return Product::where('slug', $slug)->first();
      }


}
