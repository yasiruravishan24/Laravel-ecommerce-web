<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Wishlist;
use App\Models\Cart;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth; 
use Cookie;
use Illuminate\Database\QueryException;

class UserController extends Controller
{
    function create(Request $request){

        try{

            $request->validate([
                'firstName' => 'required|alpha|max:20',
                'lastName' => 'required|alpha|max:20',
                'houseNo' => 'required|max:5',
                'street' => 'required|max:20',
                'city' => 'required|max:20',
                'district' => 'required|alpha|max:20',
                'zipCode' => 'required|numeric|digits_between:5,10',
                'phoneNo' => 'required|numeric|digits:10',
                'email' => 'required|email|max:50|unique:users,email',
                'password' => 'required|min:8|max:30',
                'conpassword' => 'required|same:password',
                'g-recaptcha-response' => 'required|captcha'
            ],[
                'conpassword.required' => 'The confirm password field is required.',
                'conpassword.same' => 'The confirm password and password must match.',
                'g-recaptcha-response.required'=> 'Please verify that you are not a robot.',
                'g-recaptcha-response.captcha'=> 'Captcha error! try again later or contact site admin.'
            ]);
    
            $id=DB::table('users')->max('id');
            $next_id= $id + 1;
    
            $user = new User();
            $user->id = $next_id;
            $user->firstName = $request->firstName;
            $user->lastName = $request->lastName;
            $user->houseNo = $request->houseNo;
            $user->street = $request->street;
            $user->city = $request->city;
            $user->district = $request->district;
            $user->zipCode = $request->zipCode;
            $user->phoneNo = $request->phoneNo;
            $user->email = $request->email;
            $user->password = \Hash::make($request->password);
            $save = $user->Save();
    
            $wishlist = new Wishlist();
            $wishlist->user_id = $next_id;
            $wishlist->save(); 
    
            $cart = new Cart();
            $cart->user_id = $next_id;
            $cart->save(); 
    
            if($save){
                return redirect()->back()->with('success','You are now reqistered successfully.');
            }else{
                return redirect()->back()->with('fail', 'Something went wrong, failed to register');
            } 

        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }

    }

    function updateProfile(Request $request, $id){

        try{
            $request->validate([
                'firstName' => 'required|alpha|max:20',
                'secondName' => 'required|alpha|max:20',
                'phone' => 'required|numeric|digits:10',
                'email' => 'required|email|max:50|unique:users,email,'.$id
            ]);
    
            $update = User::where('id', $id)
            ->update([
                'firstName' => $request->input('firstName'),
                'lastName' => $request->input('secondName'),
                'phoneNo' => $request->input('phone'),
                'email' => $request->input('email'),
            ]);
    
            if($update){
                return redirect()->back()->with('successUpdate','Details update successfully.');
            }
            else{
                return redirect()->back()->with('fail', 'Something went wrong, failed to update details');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }  
    }

    function updatePassword(Request $request, $id){

        try{
            $request->validate([
                'password' => 'required|min:8|max:30',
                'conpassword' => 'required|same:password'
            ],[
                'conpassword.required' => 'The confirm password field is required.',
                'conpassword.same' => 'The confirm password and password must match.'
            ]);
    
            $update = User::where('id', $id)
            ->update([
                'password' => \Hash::make($request->input('password'))
            ]);
    
            if($update){
                return redirect()->back()->with('successUpdatePass','Password update successfully.');
            }
            else{
                return redirect()->back()->with('failPass', 'Something went wrong, failed to update password');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }

        
    }

    function updateAddress(Request $request, $id){

        try{
            $request->validate([
                'houseNo' => 'required|max:5',
                'street' => 'required|max:20',
                'city' => 'required|max:20',
                'district' => 'required|alpha|max:20',
                'zipCode' => 'required|numeric|digits_between:5,10',
            ]);
    
            $update = User::where('id', $id)
            ->update([
                
                'houseNo' => $request->input('houseNo'),
                'street' => $request->input('street'),
                'city' => $request->input('city'),
                'district' => $request->input('district'),
                'zipCode' => $request->input('zipCode')
            ]);
    
            if($update){
                return redirect()->back()->with('successUpdate','Address update successfully.');
            }
            else{
                return redirect()->back()->with('fail', 'Something went wrong, failed to update Address');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
    }

    function check(Request $request){

        try{
            $request->validate([
                'email' => 'required|email|exists:users,email',
                'password' => 'required|min:8|max:30',
            ],[
                'email.exists' => 'The email you entered dose not exist.'
            ]);
    
    
            $creds = $request->only('email','password');
            if(Auth::attempt($creds,$request->remember)){
    
                if($request->has('remember')){
                    Cookie::queue('userEmail', $request->email,1440);
                    Cookie::queue('UserPsd',$request->password,1440);
                }else{
                    Cookie::queue('userEmail', $request->email,-1440);
                    Cookie::queue('UserPsd',$request->password,-1440);
                }
    
                return redirect()->route('user.myaccount');
            }else{
                return redirect()->route('user.login')->with('fail', 'The password you entered is incorrect.');
            }
        }
        catch(QueryException $ex){
            return redirect()->back()->with('exception-error','An error occurred, please try again later');
        }
        
    }
    function logout(){
        Auth::logout();
        return redirect()->route('user.login');
    }


    
}
