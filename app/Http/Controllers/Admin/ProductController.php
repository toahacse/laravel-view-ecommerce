<?php

namespace App\Http\Controllers\Admin;

use App\Models\Product;
use App\Models\Category;
use App\Traits\SaveFile;
use App\Models\Attribute;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;
use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Tax;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\Validator;

class ProductController extends Controller
{
    use ApiResponse;
    use SaveFile;

    public function index()
    {
        $data = Product::get();
        return view('admin/Product.index', get_defined_vars());
    }

    public function view_product($id = 0)
    {
        if ($id == 0) {
            //new Product
            $data = new Product();
            $categories = Category::get();
            $brands = Brand::get();
            $taxes = Tax::get();
        } else {
            $data['id'] = $id;

            $validation = Validator::make($data, [
                'id'  => 'required|exists:products,id',
            ]);

            if ($validation->fails()) {
                return Redirect::back();
            } else {
                $data = Product::where('id',$id)->first();
            }
        }
        return view('admin/Product.manage-product', get_defined_vars());
    }

    public function store(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'id'    => 'required|string|max:255',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            if ($request->id > 0) {
                $image = Category::where('id', $request->id)->first();
                $imageName = $image->image;
                if ($request->hasFile('image')) {
                    $imageName = $this->saveImage($request->image, $imageName, 'images/categories');
                }
            } else {
                $imageName = null;
                if ($request->hasFile('image')) {
                    $imageName = $this->saveImage($request->image, '', 'images/categories');
                }
            }

            Category::updateOrCreate(
                ['id' => $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                    'image' => $imageName,
                    'parent_category_id' => $request->parent_category_id,
                ]
            );

            return $this->success(['reload' => true], 'Successfully Update');
        }
    }

    public function getAttributes(Request $request){
        $category_id = $request->category_id;
        $data = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();

        return $this->success($data, 'Successfully Update');
    }
}
