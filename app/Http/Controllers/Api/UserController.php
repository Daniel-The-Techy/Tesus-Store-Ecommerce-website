<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use App\Models\User;
use App\Models\Product;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;


class UserController extends Controller
{
    public $id;


    public function index(Request $request){
        $data= $request->user();
        $image=$data->image ? URL::to($data->image) : null;
        $data->image=$image;
  // dd($request->user());
        $response=[
            'data'=>$data,
        ];
        return response($response, 200);
    }

    public function store(Request $request){

        $data=$request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'Email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:12|confirmed',
        ]);

        $user=User::create([
            'firstName'=>$data['firstName'],
            'lastName'=>$data['lastName'],
            'email'=>$data['Email'],
            'password'=>Hash::make($data['password'])
        ]);

        $token=$user->createToken('Auth-token')->plainTextToken;

        $response=[
            'data'=>$user,
            'token'=>$token,
        ];

        return response($response, 200);


    }

    public function Login(Request $request){
        $data=$request->validate([
            'Email'=>'required',
            'password'=>'required'
        ]);

        $user=User::where('email', $data['Email'])->first();

        //check if password is hashed 
        if(!$user || !Hash::check($data['password'], $user->password)){
            return response([
                'Message'=>'Invalid Login Credentials',
                401
            ]);
        }

    
       // $request->session()->regenerate(true);
        $token=$user->createToken('Auth-token')->plainTextToken;

        $responseData=[
            'data'=>$user,
            'token'=>$token
        ];

        return response(
            $responseData,
            200
        
        );
    }

    public function Logout(){
         auth()->user()->tokens()->delete();

         return response(
        'logout successfully',
            201
         );
    }



    public function getAllCart(Request $request){
        //   $token=Cookie::get('unique-token');
          // return Cart::select('id', 'product_id', 'quantity')->where('Session_id', $token)->get();
            $User_id=$request->user()->id;
          //  dd($User_id);
            if($User_id !== null){
             $data= Product::join('Carts', 'products.id', '=', 'carts.Product_id')
             ->select('Products.*', 'carts.quantity')
             ->where('User_id', $User_id)
             ->where('carts.user_id', '!=', 0)
             // ->where('user_id','>', 0)
              ->get();

              $response=[
                'data'=>$data
              ];
              return response($response, 200);
            }
         }
   

         public function updateUser(Request $request){
            $data=$request->validate([
                'name'=>'required',
                'email'=>'required|email',
                'image'=>'required'
            ]);
            if(isset($data['image'])){
                $relativePath=$this->saveImage($data['image']);
                $data['iamge']=$relativePath;
            }

             $user=User::where('id', $request->user()->id)
             ->update(['name'=>$data['name'], 'email'=>$data['email'], 'image'=>$data['iamge']]);

            // if($user->image){
                $image=$request->user()->image;
              if($image){
                    $absolutePath=public_path($image);
                    File::delete($absolutePath);
              }
//}

         }

         public function saveImage($image){

            if(preg_match('/^data:image\/(\w+);base64,/', $image, $match)){

                $image=substr($image, strpos($image, ',') + 1);

                $type=strtolower($match[1]);

                if(!in_array($type, ['jpg', 'png', 'jpeg'])){
                    throw new Exception('base encoded failed');
                }
                $image=str_replace(' ', '+', $image);
                $image=base64_decode($image);

                if($image == false){
                    throw new Exception('please provide a valid image');
                }


            }else{
                throw new Exception('did not match data URL with image data');
            }

            $dir='images/';
            $file=Str::random(). '.' .$type;
            $absolutePath=public_path($dir);
            $relativePath=$dir . $file;

            if(!File::exists($absolutePath)){
                File::makeDirectory($absolutePath, 0755, true);
            }
            file_put_contents($relativePath, $image);

            return $relativePath;
         }



         public function updatePassword(Request $request){
            $Password=$request->input('Password');
            $hashPassword=Hash::make($Password);
            return User::where('id', $request->user()->id)->update(['password' => $hashPassword]);
         }
        

         
}

