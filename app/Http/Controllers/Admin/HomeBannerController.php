<?php

namespace App\Http\Controllers\Admin;

use App\Models\HomeBanner;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class HomeBannerController extends Controller
{
    use ApiResponse;
    
    public function index(){
        $data = HomeBanner::get();
        return view('admin/HomeBanner.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'text'  => 'required|string|max:255',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'link'  => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            if($request->hasFile('image')){
                if($request->id > 0){
                   $image = HomeBanner::where('id', $request->id)->first();
                   $image_path = "images/".$image->image."";
                   if(File::exists($image_path)){
                    File::delete($image_path);
                   }
                }
                $image_name = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
            }elseif($request->id>0){
                $image_name = HomeBanner::where('id', $request->id)->pluck('image')->first();
            }
 
            HomeBanner::updateOrCreate(
                ['id'=> $request->id],
                [
                    'text' => $request->text,
                    'link' => $request->link,
                    'image' => $image_name,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
