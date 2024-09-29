<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\Role;
use App\Models\User;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    use ApiResponse;

    public function register(Request $request)
    {
        $validation = Validator::make($request->all(),[
            'name'    => 'required|string|max:255',
            'email'   => 'required|string|email|unique:users,email',
            'password'=> 'required|string|min:6'
        ]);
   
        if($validation->fails()){
            return $this->error($validation->errors()->first(),400,[]);
   
        }
 
        $user = User::create([
            'name' => $request->name,
            'password' => bcrypt($request->password),
            'email' => $request->email
        ]);
 
        $customer = Role::where('slug', 'customer')->first();
        $user->roles()->attach($customer);

        return $this->success([
            'token' => $user->createToken('API Token')->plainTextToken
        ]);
    }


    public function loginUser(Request $request){
        $validation = Validator::make($request->all(), [
             'email' => 'required|string|email|exists:users,email',
             'password' => 'required|string|min:6'
        ]);

        if($validation->fails()){
            return response()->json(['status'=> 400, 'message'=>$validation->errors()->first()]);
        }else{
            $cred = array('email'=>$request->email, 'password'=>$request->password);
            if (Auth::attempt($cred, false)) {
               if(Auth::User()->hasRole('admin')){
                    return response()->json(['status'=> 200, 'message'=>'Admin User', 'url' => 'admin/dashboard']);
               }else{
                    $user = User::find(Auth::user()->id);
                    $user->token = $user->createToken('API Token')->plainTextToken;
                    // return response()->json(['status'=> 200, 'message'=>'Succesfull login']);
                    return $this->success(
                        [
                            'user' => $user,
                        ], 
                        'succesfull login'
                    );
               }
            }else{
                return response()->json(['status'=> 404, 'message'=>'Wrong Credentials']);
            }
        }
    }

    public function updateUser(Request $request){

        $validation = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            // 'email' => 'required|string|email|exists:users,email',
            // 'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            // 'address' => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            $user = User::updateOrCreate(
                ['id' => Auth::user()->id],
                ['name'=>$request->name]
                // ['name'=>$request->name,'email'=>$request->email, 'phone'=> $request->phone,'address'=>$request->address,'twitter_link'=>$request->twitter_link,'fb_link'=>$request->fb_link,'insta_link'=>$request->insta_link,]
            );

            return $this->success(
                [
                    'user' => $user,
                ], 
                'successfully updated'
            );
        }
    }

    public function logout()
    {
        auth()->user()->tokens()->delete();
 
        return [
            'message' => 'Tokens Revoked'
        ];
    }
}
