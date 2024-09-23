<?php

namespace App\Http\Controllers\Admin;

use App\Models\Brand;
use App\Traits\SaveFile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class BrandController extends Controller
{
    use ApiResponse;
    use SaveFile;
    
    public function index(){
        $data = Brand::get();
        return view('admin/Brand.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'text'  => 'required|string|max:255',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            if($request->id > 0){
                $image = Brand::where('id', $request->id)->first();
                $imageName = $image->image;
                if($request->hasFile('image')){
                    $imageName = $this->saveImage($request->image, $imageName, 'images/brands' );
                }
            }else{
                $imageName = null;
                if($request->hasFile('image')){
                    $imageName = $this->saveImage($request->image, '', 'images/brands' );
                }
            }
 
            Brand::updateOrCreate(
                ['id'=> $request->id],
                [
                    'text' => $request->text,
                    'image' => $imageName,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
