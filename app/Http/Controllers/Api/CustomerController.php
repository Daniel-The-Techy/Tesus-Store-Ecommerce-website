<?php

namespace App\Http\Controllers\Api;

use Exception;
use App\Models\Cart;
use App\Models\Order;
use App\Models\Product;
use App\Models\Customer;
use Illuminate\Support\Str;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\URL;
use App\Http\Controllers\Controller;
use App\Models\Order_details;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Cookie;

class CustomerController extends Controller
{
    

    public function index(Request $request){
        $data= $request->user();
        $image=$data->image ? URL::to($data->image) : null;
        $data->image=$image;
        $response=[
            'data'=>$data,
        ];
        return response($response, 200);
    }

    public function store(Request $request){

        $data=$request->validate([
            'firstname'=>'required|string',
            'lastname'=>'required|string',
            'email'=>'required|email|unique:users',
            'password'=>'required|min:6|max:12|confirmed',

        ]);

        $user=Customer::create([
            'firstname'=>$data['firstname'],
            'lastname'=>$data['lastname'],
            'email'=>$data['email'],
            'password'=>Hash::make($data['password']),

        ]);

        $token=Cookie::get('unique-token');

        $Cart=Cart::where('Session_id', $token)->count();

        if($Cart > 0){
            Cart::where('Session_id', $token)->where('user_id', 0)
            ->update(['user_id'=>$user->id]);
        }

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
            'password'=>'required',
        ]);

        $user=Customer::where('email', $data['Email'])->first();

       
        if(!$user || !Hash::check($data['password'], $user->password)){
     //   if(!Auth::attempt($data)){
            $errors=[
                'error'=>'Invalid Login Credentials'
            ];
            return response($errors, 422);
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
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'email'=>'required|email',
            'image'=>'required'
        ]);
        if(isset($data['image'])){
            $relativePath=$this->saveImage($data['image']);
            $data['iamge']=$relativePath;
        }

         $user=Customer::where('id', $request->user()->id)
         ->update(['firstName'=>$data['firstName'], 'lastName'=>$data['lastName'],
          'email'=>$data['email'], 'image'=>$data['iamge']]);

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






    public function Logout(){
        auth()->user()->tokens()->delete();

        return response(
       'logout successfully',
           201
        );
   }

   public function updateAddress(Request $request){
          $data=$request->validate([
            'phone_Number'=>'required|int',
            'company'=>'required|string',
            'Address_1'=>'required|string',
            'Address_2'=>'required|string',
            'city'=>'required|string',
            'country'=>'required|string',
            'State'=>'required|string',
             'Postal_Code'=>'required|int'
          ]);

          $id=$request->user()->id;

          Order_details::where('user_id', $id)->update([
            'phone_Number'=>$data['phone_Number'],
            'company'=>$data['company'],
            'Address_1'=>$data['Address_1'],
            'Address_2'=>$data['Address_2'],
            'city'=>$data['city'],
            'country'=>$data['country'],
            'State'=>$data['State'],
            'Postal_Code'=>$data['Postal_Code']
          ]);

          $response=[
            'message'=>'Address updated successfully',
            200
          ];

          return response($response);
   }


   public function CustomerCheckOut(Request $request){
     //   $User_id=$request->user()->id;


        $data=$request->validate([
            'firstName'=>'required|string',
            'lastName'=>'required|string',
            'phone_Number'=>'required',
            'company'=>'required|string',
            'Address_1'=>'required|string',
            'Address_2'=>'required|string',
            'city'=>'required|string',
            'Postal_Code'=>'required',
            'country'=>'required|string',
            'State'=>'required|string'
        ]);

        $user=Order_details::create([
            'customers_id'=>$request->user()->id,
            'firstName'=>$data['firstName'],
            'lastName'=>$data['lastName'],
            'phone_Number'=>$data['phone_Number'],
            'company'=>$data['company'],
            'Address_1'=>$data['Address_1'],
            'Address_2'=>$data['Address_2'],
            'city'=>$data['city'],
            'Postal_Code'=>$data['Postal_Code'],
            'country'=>$data['country'],
            'State'=>$data['State']

        ]);



        

       


          
    }
    

    
      // 


     public function customerOrder(Request $request){
        //Continue later
        $OrderNote=$request->input('OrderNote');
        $PaymentType=$request->input('paymentType');

        $Carts=Cart::where('user_id', $request->user()->id)->get();
        
        
        if($Carts !==null){
            foreach($Carts as $Cart){
          $Order=new Order();
          $Order->users_id=$Cart->user_id;
          $Order->Product_id=$Cart->Product_id;
          $Order->quantity=$Cart->quantity;
          $Order->payment_type=$PaymentType;
          $Order->OrderNote=$OrderNote;
      if($Order->save()){
                 $Cart->delete();
         }
        }


     }
       

    }

}
