<?php

namespace App\Http\Controllers\Admin;

use App\Models\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Traits\ApiResponse;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    use ApiResponse;

    public function index(){
        return view('admin.profile');
    }

    public function saveProfile(Request $request){
        $validation = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'email' => 'required|string|email|exists:users,email',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'address' => 'required|string|max:255'
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 200, []);
        }else{
            if($request->hasFile('image')){
                $image_name = 'images/'.$request->name.time().'.'.$request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
            }else{
                $image_name = Auth::user()->image;
            }

            $user = User::updateOrCreate(
                        ['id' => Auth::user()->id],
                        ['name'=>$request->name,'email'=>$request->email, 'phone'=> $request->phone, 'image'=>$image_name,'address'=>$request->address,'twitter_link'=>$request->twitter_link,'fb_link'=>$request->fb_link,'insta_link'=>$request->insta_link,]
                    );

            return $this->success($user,'Successfully Update');
        }
    }
}
