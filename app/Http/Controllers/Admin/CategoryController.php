<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponse;
    
    public function index(){
        $data = Category::get();
        return view('admin/Category.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            if($request->hasFile('image')){
                if($request->id > 0){
                   $image = Category::where('id', $request->id)->first();
                   $image_path = "images/".$image->image."";
                   if(File::exists($image_path)){
                    File::delete($image_path);
                   }
                }
                $image_name = time().'.'.$request->image->extension();
                $request->image->move(public_path('images/'), $image_name);
            }elseif($request->id>0){
                $image_name = Category::where('id', $request->id)->pluck('image')->first();
            }
 
            Category::updateOrCreate(
                ['id'=> $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $image_name,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
