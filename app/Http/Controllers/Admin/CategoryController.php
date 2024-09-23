<?php

namespace App\Http\Controllers\Admin;

use App\Models\Category;
use App\Traits\SaveFile;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;
use App\Http\Controllers\Controller;
use App\Models\Attribute;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CategoryController extends Controller
{
    use ApiResponse;
    use SaveFile;
    
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
            if($request->id > 0){
                $image = Category::where('id', $request->id)->first();
                $imageName = $image->image;
                if($request->hasFile('image')){
                    $imageName = $this->saveImage($request->image, $imageName, 'images/categories' );
                }
             }else{
                $imageName = null;
                if($request->hasFile('image')){
                    $imageName = $this->saveImage($request->image, '', 'images/categories' );
                }
             }
 
            Category::updateOrCreate(
                ['id'=> $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $imageName,
                    'parent_category_id' => $request->parent_category_id,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }

    public function index_category_attribute(){
        $data = CategoryAttribute::with('category','attribute')->get();
        $categories = Category::get();
        $attributes = Attribute::get();
        return view('admin/Category.index-category-attribute', get_defined_vars());
    }

    
    public function store_category_attribute(Request $request){
        $validation = Validator::make($request->all(), [
            'category_id'  => 'required|exists:categories,id',
            'attribute_id'  => 'required|exists:attributes,id',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            
            CategoryAttribute::updateOrCreate(
                ['id'=> $request->id],
                [
                    'category_id' => $request->category_id,
                    'attribute_id' => $request->attribute_id,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }

}
