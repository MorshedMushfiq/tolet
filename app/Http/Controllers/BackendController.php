<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Session;

class BackendController extends Controller
{

    public function dashboard(){
        return view('backend.dashboard');
    }


    public function register(){
        return view('backend.register');
    }

       // register any user method
       public function registerUser(Request $request)
       {
           //validation 
           $this->validate($request, [
               "email" => ["unique:users"],
           ]);
   
           //image unique name generation.
           if ($request->hasFile('file')) {
               $img = $request->file('file');
               $unique_name = md5(time() . rand() . "." . $img->getClientOriginalExtension());
               $img->move(public_path("uploads/profiles"), $unique_name);
           }
           //for register in database
           $user = new User;
           $user->name = $request->name;
           $user->email = $request->email;
           $user->image = $unique_name;
           $user->password = HASH::make($request->password);
           //$user->remember_token = time().rand();
           $user->save();
   
           //user information array for sending in registermail.
        //    $user_info =[
        //        "id" => $user->id,
        //        "name" => $request->name,
        //        "type" => $request->type,
        //        "email" => $request->email,
        //        "password" => $request->password,
        //        "remember_token" => $user->remember_token,
        //    ];
   
   
           //send mail
        //    Mail::to($request->email)->send(new RegisterMail($user_info));
        return redirect()->route('admin.login')->with("success", "Congratulations $request->name, Your Account is ready");
        //, please verify your account via email
       }



              //login any user with verification and restrictions.
    public function loginUser(Request $request)
    {
        $credetials = [
            'email' => $request->email,
            'password' => $request->password,
        ];

        if (Auth::attempt($credetials)) { 
            //$auth_type = Auth::user()->type;
            $auth_status = Auth::user()->user_status;
            // $auth_user_status = Auth::user()->status;
            // $auth_remember_token = Auth::user()->remember_token;

                // if($auth_user_status == false || $auth_remember_token != NULL){
                //     Session::flush();
                //     Auth::guard("web")->logout();
                //     return redirect()->route('cake.login')->with('error', "Please verify your account via mail");
                return redirect()->route("admin.dashboard")->with('success', "Login Success!!!!");
                   

        }else {
            return redirect()->route('admin.login')->with('error', "Email or Password has been wrong");
        }
    }


    public function login(){
        return view('backend.login');
    }

    
    //logout method
    public function logoutUser()
    {
        Session::flush();
        Auth::guard("web")->logout();
        return redirect()->route('admin.login')->with('success', "logged out successfully");
    }
    
    public function product(){
        $products = Product::all();
        return view('backend.products', compact('products'));
    }


        



    
//upload blog method
public function uploadProduct(Request $request){
    if(Auth::user()!=null){
         //unique img name generation
         if($request->hasFile('product_image')){
            $img = $request->file('product_image');
            $unique_name= md5(time().rand()). "." . $img->getClientOriginalExtension();
            $img->move(public_path("uploads/products"), $unique_name);
        }

         //unique img name generation
         if($request->hasFile('images2')){
            $img = $request->file('images2');
            $unique_name2= md5(time().rand()). "." . $img->getClientOriginalExtension();
            $img->move(public_path("uploads/products"), $unique_name2);
        }

          //unique img name generation
          if($request->hasFile('images3')){
            $img = $request->file('images3');
            $unique_name3= md5(time().rand()). "." . $img->getClientOriginalExtension();
            $img->move(public_path("uploads/products"), $unique_name3);
        }

        $product = new Product;
        $product->product_name = $request->product_title;
        $product->product_images = $unique_name;
        $product->images2 = $unique_name2;
        $product->images3 = $unique_name3;
        $product->product_description = $request->product_description;
        $product->save();
         return redirect()->back()->with("success", "Notice Upload Succcess");
        // return response()->json([
        //     "status" => "success",
        //     "msg" => "Data Uploaded Success"
        // ]);
    }
}



    //update notice
    public function updateProduct(Request $request){
            if(Auth::user()!=null){
            //image unique name generation.
            if($request->hasFile('up_product_image')){
                $img = $request->file('up_product_image');
                $unique_name = md5(time().rand().".". $img->getClientOriginalExtension());
                $img->move(public_path("uploads/products"), $unique_name);
            }

              //unique img name generation
         if($request->hasFile('images2')){
            $img = $request->file('images2');
            $unique_name2= md5(time().rand()). "." . $img->getClientOriginalExtension();
            $img->move(public_path("uploads/products"), $unique_name2);
        }

          //unique img name generation
          if($request->hasFile('images3')){
            $img = $request->file('images3');
            $unique_name3= md5(time().rand()). "." . $img->getClientOriginalExtension();
            $img->move(public_path("uploads/products"), $unique_name3);
        }
    
            $product = Product::find($request->up_id);
            //dd($notice->notice_title);

            $product->product_name = $request->up_product_title;

            if(!empty($unique_name) && !empty($unique_name2) && !empty($unique_name3)){
                $product->product_image=$unique_name;
                $product->images2=$unique_name2;
                $product->images3=$unique_name3;
            }

            $product->product_description = $request->up_product_description;

            $product->save();

             // return redirect()->back()->with("success", "Notice Updated Successfull!!");
            return response()->json([
                "status" => "success",
                "msg" => "Data Updated Success"
            ]);
            
        }

        
    }

    //delete post.
    public function deleteProduct(Request $request){
        $delete_product = Product::find($request->delete_id);
        
        $delete_product->delete();            
        //return redirect()->back()->with('success', "Notice deleted Successfull");
        return response()->json([
            "status" => "success",
            "msg" => "Data Delete Success"
        ]);
        
    }

    public function paginationProduct(){
        $products = Product::latest()->paginate(3);
        return view("admin.pagination-notice", compact("products"));   
    }

    


}
