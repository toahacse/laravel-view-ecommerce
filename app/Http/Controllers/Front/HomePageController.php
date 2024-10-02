<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Models\Category;
use App\Models\CategoryAttribute;
use App\Models\Color;
use App\Models\HomeBanner;
use App\Models\Product;
use App\Models\ProductAttr;
use App\Models\Size;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;

class HomePageController extends Controller
{
    use ApiResponse;

    public function getHeaderCategoriesData(){
        $data['categories'] = Category::with('subcategories')->where('parent_category_id', null)->get();
        return $this->success(['data'=>$data],'Successfully data fetched');
    }


    public function getHomeData(Request $request){
        $data = [];
        $data['banner'] = HomeBanner::get();
        $data['categories'] = Category::with('products:id,category_id,name,slug,image,item_code')->get();
        $data['brands'] = Brand::get();
        $data['products'] = Product::with('productAttributes')->select('id','category_id','name','slug','image','item_code')->get();
        return $this->success(['data'=>$data],'Successfully data fetched');
    }

    public function getCategoryData($slug=''){
        $category = Category::where('slug', $slug)->first();
        if(isset($category->id)){
            $products = Product::where('category_id',$category->id)->with('productAttributes')->select('id','category_id','name','slug','image','item_code')->paginate(10);
            if($category->parent_category_id == null || $category->parent_category_id == ''){
                $categories = Category::where('parent_category_id', $category->id)->get();
            }else{
                $categories = Category::where('parent_category_id', $category->parent_category_id)->where('id', '!=', $category->id)->get();
            }
        }else{
            $category = Category::first();
            $products = Product::where('category_id',$category->id)->with('productAttributes')->select('id','category_id','name','slug','image','item_code')->paginate(10);
            if($category->parent_category_id == null || $category->parent_category_id == ''){
                $categories = Category::where('parent_category_id', $category->id)->get();
            }else{
                $categories = Category::where('parent_category_id', $category->parent_category_id)->where('id', '!=', $category->id)->get();
            }
        }

        $lowPrice = ProductAttr::orderBy('price', 'asc')->pluck('price')->first();
        $highPrice = ProductAttr::orderBy('price', 'desc')->pluck('price')->first();

        // $prices = ProductAttr::selectRaw('MIN(price) as lowPrice, MAX(price) as highPrice')->first();

        // $lowPrice = $prices->lowPrice;
        // $highPrice = $prices->highPrice;
        $brands = Brand::get();
        $colors = Color::get();
        $sizes = Size::get();
        $attributes = CategoryAttribute::where('category_id', $category->id)->with('attribute')->get();
        return $this->success(['data'=> get_defined_vars()],'Successfully data fetched');
    }

    public function changeSlug(){
        $data = Product::get();

        foreach($data as $list){
            $result = Product::find($list->id);
            $result->slug = replaceStr($result->name);
            $result->save();
        }
    }
}
