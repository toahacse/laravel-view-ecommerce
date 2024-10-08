<?php

namespace App\Http\Controllers\Front;

use App\Models\Cart;
use App\Models\Size;
use App\Models\Brand;
use App\Models\Color;
use App\Models\Product;
use App\Models\Category;
use App\Models\TempUsers;
use App\Models\HomeBanner;
use App\Models\ProductAttr;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Models\CategoryAttribute;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Models\Coupon;
use App\Models\Pincode;
use App\Models\Role;
use App\Models\User;
use App\Models\UserCoupon;
use Illuminate\Support\Facades\Hash;
use SebastianBergmann\Template\Template;
use Illuminate\Support\Facades\Validator;

class HomePageController extends Controller
{
    use ApiResponse;

    public function getHeaderCategoriesData()
    {
        $data['categories'] = Category::with('subcategories')->where('parent_category_id', null)->get();
        return $this->success(['data' => $data], 'Successfully data fetched');
    }

    public function getHomeData(Request $request)
    {
        $data = [];
        $data['banner'] = HomeBanner::get();
        $data['categories'] = Category::with('products:id,category_id,name,slug,image,item_code')->get();
        $data['brands'] = Brand::get();
        $data['products'] = Product::with('productAttributes')->select('id', 'category_id', 'name', 'slug', 'image', 'item_code')->get();
        return $this->success(['data' => $data], 'Successfully data fetched');
    }

    public function getCategoryData(Request $request)
    {
        $slug       = $request->slug;
        $attribute  = $request->attribute;
        $brand      = $request->brand;
        $size       = $request->size;
        $color      = $request->color;
        $highPrice  = $request->highPrice;
        $lowPrice   = $request->lowPrice;

        $category = Category::where('slug', $slug)->first();
        if (isset($category->id)) {
            // $products = Product::where('category_id',$category->id)->with('productAttributes')->select('id','category_id','name','slug','image','item_code')->paginate(10);
            $products = $this->getFilterProducts($category->id, $size, $color, $brand, $attribute, $lowPrice, $highPrice);
            if ($category->parent_category_id == null || $category->parent_category_id == '') {
                $categories = Category::where('parent_category_id', $category->id)->get();
            } else {
                $categories = Category::where('parent_category_id', $category->parent_category_id)->where('id', '!=', $category->id)->get();
            }
        } else {
            $category = Category::first();
            // $products = Product::where('category_id',$category->id)->with('productAttributes')->select('id','category_id','name','slug','image','item_code')->paginate(10);
            if ($category->parent_category_id == null || $category->parent_category_id == '') {
                $categories = Category::where('parent_category_id', $category->id)->get();
            } else {
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
        return $this->success(['data' => get_defined_vars()], 'Successfully data fetched');
    }

    public function getProductData($item_code='', $slug='')
    {
        $product = Product::where(['item_code'=>$item_code, 'slug'=>$slug])->with('productAttributes')->first();
        if (isset($product->id)) {
            $product['otherProducts'] =  Product::where('id','!=', $product->id)->where('category_id' , $product->category_id)->with('productAttributes')->get();
            return $this->success(['data' => $product], 'Successfully data fetched');
        }else{
            return $this->error('Product not found', 400, []);
        }
    }

    public function changeSlug()
    {
        $data = Product::get();

        foreach ($data as $list) {
            $result = Product::find($list->id);
            $result->slug = replaceStr($result->name);
            $result->save();
        }
    }

    private function getFilterProducts($category_id, $size, $color, $brand, $attribute, $lowPrice, $highPrice)
    {
        $products = Product::where('category_id', $category_id);

        if (sizeof($brand) > 0) {
            $products = $products->whereIn('brand_id', $brand);
        }

        if (sizeof($attribute) > 0) {
            $products = $products->whereHas('attributes', function ($q) use ($attribute) {
                $q->whereIn('attribute_value_id', $attribute);
            });
        }

        if (sizeof($size) > 0) {
            $products = $products->whereHas('productAttributes', function ($q) use ($size) {
                $q->whereIn('size_id', $size);
            });
        }

        if (sizeof($color) > 0) {
            $products = $products->whereHas('productAttributes', function ($q) use ($color) {
                $q->whereIn('color_id', $color);
            });
        }

        if ($lowPrice != '' && $lowPrice != null && $highPrice != '') {
            $products = $products->whereHas('productAttributes', function ($q) use ($lowPrice, $highPrice) {
                $q->whereBetween('price', [$lowPrice, $highPrice]);
            });
        }

        $products = $products->with('productAttributes')->select('id', 'category_id', 'name', 'slug', 'image', 'item_code')->paginate(10);

        return $products;
    }

    public function getUserData(Request $request)
    {
        $token = $request->token;
        $checkUser = TempUsers::where('token', $token)->first();

        if (isset($checkUser->id)) {
            // exist in DB
            $data['user_type'] = $checkUser->user_type;
            $data['token'] = $checkUser->token;

            if (checkTokenExpiryInMinutes($checkUser->updated_at, 60)) {
                // token expire
                $token = generateRandomString();
                $checkUser->token = $token;
                $checkUser->updated_at = now();
                $checkUser->save();

                $data['token'] = $token;
            } else {
                // token not expire
            }
        } else {
            //not exist in DB
            $user_id = rand(11111, 99999);
            $token = generateRandomString();
            $time = date('Y-m-d h:i:s a', time());
            TempUsers::create([
                'user_id' => $user_id,
                'token' => $token,
                'created_at' => $time,
                'updated_at' => $time,
            ]);

            $data['user_type'] = 2;
            $data['token'] = $token;
        }
        return $this->success(['data' => $data], 'Successfully data fetched');
    }

    public function getCartData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'  => 'required|exists:temp_users,token',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $userToken = TempUsers::where('token', $request->token)->first();
            $data = Cart::where('user_id', $userToken->user_id)->with('products')->get();
            return $this->success(['data' => $data], 'Successfully data fetched');
        }
    }

    public function addToCart(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'             => 'required|exists:temp_users,token',
            'product_id'        => 'required|exists:products,id',
            'product_attr_id'   => 'required|exists:product_attrs,id',
            'qty'               => 'required|numeric|min:1',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $user = TempUsers::where('token', $request->token)->first();
            Cart::updateOrCreate(
                [
                    'user_id'=> $user->user_id,
                    'product_id'=> $request->product_id,
                    'product_attr_id'=> $request->product_attr_id,
                ],
                [
                    'user_id'=> $user->user_id,
                    'product_id'=> $request->product_id,
                    'product_attr_id'=> $request->product_attr_id,
                    'qty' => DB::raw('qty + ' . $request->qty),
                    'user_type' => $user->user_type,
                ],
            );
            return $this->success(['data' => ''], 'Successfully data fetched');
        }
    }

    public function removeCartData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'             => 'required|exists:temp_users,token',
            'product_id'        => 'required|exists:products,id',
            'product_attr_id'   => 'required|exists:product_attrs,id',
            'qty'               => 'required|numeric|min:1',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $user = TempUsers::where('token', $request->token)->first();
            $cart = Cart::where(
                        [
                            'user_id'=> $user->user_id,
                            'product_id'=> $request->product_id,
                            'product_attr_id'=> $request->product_attr_id,
                        ],
                    )->first();

            if(isset($cart->id)){
                $qty = $request->qty;
                if($cart->qty == $qty){
                    $cart->delete();
                }elseif($cart->qty > $qty){
                    $cart->qty -= $qty;
                    $cart->save();
                }else{
                    $cart->delete();
                }
            }
            return $this->success(['data' => ''], 'Successfully data fetched');
        }
    }

    public function addCoupon(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'             => 'required|exists:temp_users,token',
            'coupon'        => 'required|exists:coupons,name',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $coupon = Coupon::where('name', $request->coupon)->first();
            $user = TempUsers::where('token', $request->token)->first();

            if($coupon->minValue <= $request->cartTotal){
                $couponValue = $coupon->value;
                if($coupon->type == 1){
                   $cartTotal = $request->cartTotal - $couponValue;
                }else{
                    $couponValue = $couponValue / 100;
                    $couponValue = $request->cartTotal * $couponValue;
                    $cartTotal = $request->cartTotal - $couponValue;
                }
                UserCoupon::updateOrCreate(
                    [
                        'user_id' => $user->user_id
                    ],
                    [
                        'user_id' => $user->user_id,
                        'coupon_id' => $coupon->id,
                    ]
                );
                return $this->success(['data' => $cartTotal, 'couponName'=>$coupon->name ?? ''], 'Successfully data fetched');
            }else{
                return $this->error('Coupon not found', 400, []);
            }
        }
    }

    public function removeCoupon(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'             => 'required|exists:temp_users,token',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $user = TempUsers::where('token', $request->token)->first();
            $couponUser = UserCoupon::where('user_id', $user->user_id)->delete();

            return $this->success(['data' => ''], 'Successfully Removed');
        }
    }

    public function getUserCoupon(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'             => 'required|exists:temp_users,token',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $user = TempUsers::where('token', $request->token)->first();
            $couponUser = UserCoupon::where('user_id', $user->user_id)->first();

            if(isset($couponUser->id)){
                $coupon = Coupon::where('id', $couponUser->coupon_id)->first();

                if($coupon->minValue <= $request->cartTotal){
                    $couponValue = $coupon->value;
                    if($coupon->type == 1){
                       $cartTotal = $request->cartTotal - $couponValue;
                    }else{
                        $couponValue = $couponValue / 100;
                        $couponValue = $request->cartTotal * $couponValue;
                        $cartTotal = $request->cartTotal - $couponValue;
                    }
                }else{
                    $cartTotal = $request->cartTotal;
                }
            }else{
                $cartTotal = $request->cartTotal;
            }
            return $this->success(['data' => $cartTotal, 'couponName'=>$coupon->name ?? ''], 'Successfully data fetched');

        }
    }

    public function getPincodeData(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'   => 'required|exists:temp_users,token',
            'pincode'   => 'required',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $pincode = Pincode::where('postCode', $request->pincode)->first();
            return $this->success(['data' => $pincode], 'Successfully data fetched');

        }
    }

    public function placeOrder(Request $request)
    {
        $validation = Validator::make($request->all(), [
            'token'         => 'required|exists:temp_users,token',
            'firstName'     => 'required|max:255',
            'lastName'      => 'required|max:255',
            'email'         => 'required|max:255',
            'address'       => 'required|max:255',
            'country'       => 'required|max:255',
            'city'          => 'required|max:255',
            'state'         => 'required|max:255',
            'pincode'       => 'required|max:255',
            'phone'         => 'required|max:255',
            'paymentMethod' => 'required|max:255',
        ]);

        if ($validation->fails()) {
            return $this->error($validation->errors()->first(), 400, []);
        } else {
            $user_id = $this->createUser($request->all());

            return $this->success(['data' => $user_id], 'Successfully data fetched');
        }
    }

    public function createUser($data){
        $user = User::create([
            'name' => $data['firstName'].' '.$data['lastName'],
            'password' => Hash::make($data['firstName'].'@123') ,
            'email' => $data['email'],
        ]);


      $customer = Role::where('slug','customer')->first();

      $user->roles()->attach($customer);
      return $user->id;
    }
}
