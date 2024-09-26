<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Traits\SaveFile;
use App\Models\Attribute;
use App\Models\ProductAttr;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\ProductAttrImage;
use App\Models\CategoryAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\ProductAttribute;
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
        $categories = Category::get();
        $brands = Brand::get();
        $colors = Color::get();
        $sizes = Size::get();
        $taxes = Tax::get();

        if ($id == 0) {
            //new Product
            $data = new Product();
            $product_attr = new ProductAttr();
            $product_attr_images = new ProductAttrImage();
        } else {
            $data['id'] = $id;

            $validation = Validator::make($data, [
                'id'  => 'required|exists:products,id',
            ]);

            if ($validation->fails()) {
                return Redirect::back();
            } else {
                $data = Product::where('id', $id)->with('attributes', 'productAttributes')->first();
            }
        }
        return view('admin/Product.manage-product', get_defined_vars());
    }

    public function store(Request $request)
    {
        // echo "<pre>";
        // print_r($request->all());
        // die();
        $validation = Validator::make($request->all(), [
            'name'  => 'required|string|max:255',
            'slug'  => 'required|string|max:255',
            'image' => 'max:5120|mimes:jpeg,png,jpg,gif',
            'id'    => 'required',
            'category_id' => 'required|exists:categories,id',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            try {
                if ($request->hasFile('image')) {
                    if ($request->id > 0) {
                        $image = Product::where('id', $request->id)->first();
                        $image_path = "images/products/" . $image->image . "";
                        if (File::exists($image_path)) {
                            File::delete($image_path);
                        }
                    }
                    $image_name = "images/products/" . $request->name . '-' . time() . '.' . $request->image->extension();
                    $request->image->move(public_path("images/products/"), $image_name);
                } elseif ($request->id > 0) {
                    $image_name = Product::where('id', $request->id)->pluck('image')->first();
                }

                DB::beginTransaction();

                $product = Product::updateOrCreate(
                    ['id' => $request->id],
                    [
                        'name'          => $request->name,
                        'slug'          => $request->slug,
                        'category_id'   => $request->category_id,
                        'brand_id'      => $request->brand_id,
                        'tax_id'        => $request->tax_id,
                        'description'   => $request->description,
                        'item_code'     => $request->item_code,
                        'keywords'      => $request->keywords,
                        'image'         => $image_name,
                    ]
                );

                ProductAttribute::where('product_id', $product->id)->delete();
                foreach ($request->attribute_id as $key => $val) {
                    ProductAttribute::updateOrCreate(
                        [
                            'product_id' => $product->id,
                            'category_id' => $request->category_id,
                            'attribute_value_id' => $val
                        ],
                        [
                            'product_id' => $product->id,
                            'category_id' => $request->category_id,
                            'attribute_value_id' => $val
                        ]
                    );
                    $attrImage = [];
                    foreach ($request->imageValue as $key => $val) {
                        array_push($attrImage, $val);
                    }
                    
                    foreach ($request->sku as $key => $val) {
                        $productAttr = ProductAttr::updateOrCreate(
                            [
                                // 'id' => $paid,
                                'id' => $request->productAttributeId[$key],
                            ],
                            [
                                'product_id' => $product->id,
                                'color_id'   => $request->color_id[$key],
                                'size_id'    => $request->size_id[$key],
                                'sku'        => $request->sku[$key],
                                'mrp'        => $request->mrp[$key],
                                'price'      => $request->price[$key],
                                'length'     => $request->length[$key],
                                'breadth'    => $request->breadth[$key],
                                'height'     => $request->height[$key],
                                'weight'     => $request->weight[$key],
                            ]
                        );
                 
                        ProductAttrImage::whereIn('id', $request->remove_image_id)->delete();
                        $imageVal = 'attr_image_'.$attrImage[$key];
                        $imageValId = 'attr_image_id_'.$attrImage[$key];
                        if($request->$imageVal){
                            if($request->$imageValId){
                                ProductAttrImage::where(['product_id' =>$product->id, 'product_attr_id' => $productAttr->id])->whereNotIn('id', $request->$imageValId)->delete();
                            }else{
                                ProductAttrImage::where(['product_id' =>$product->id, 'product_attr_id' => $productAttr->id])->delete();
                            }
                            foreach($request->$imageVal as $key=>$val){
                                $image_name = "images/productsAttr/".$this->getRandomValue().$request->name . '-' . time() . '.' . $val->extension();
                                $val->move(public_path("images/productsAttr/"), $image_name);
    
                                ProductAttrImage::updateOrCreate(
                                    [
                                        'product_id' => $product->id,
                                        'product_attr_id' => $productAttr->id,
                                        'image' => $image_name
                                    ],
                                    [
                                        'product_id' => $product->id,
                                        'product_attr_id' => $productAttr->id,
                                        'image' => $image_name
                                    ]
                                );
                            }
                        }
                    }

                }
                DB::commit();

                return $this->success(['reload' => false], 'Successfully Update');
            } catch (\Throwable $th) {
                //throw $th;
                DB::rollBack(); // if error occurs rollback all database queries
                return $this->error($th, 400, ['error' => $th->getMessage(), 'line'=>$th->getLine()]);
            }
        }
    }

    public function getAttributes(Request $request)
    {
        $category_id = $request->category_id;
        $data = CategoryAttribute::where('category_id', $category_id)->with('attribute', 'values')->get();

        return $this->success($data, 'Successfully Update');
    }

    public function getRandomValue(){
        return rand(111111, 999999);
    }
}
