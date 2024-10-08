<?php

namespace App\Http\Controllers\Admin;

use App\Models\Coupon;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class CouponController extends Controller
{
    use ApiResponse;

    public function index(){
        $data = Coupon::get();
        return view('admin/Coupon.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'name'      => 'required|string|max:255',
            'type'      => 'required|string|max:255',
            'value'     => 'required|numeric|max:255',
            'minValue'  => 'required|numeric|max:255',
            'id'        => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            Coupon::updateOrCreate(
                ['id'=> $request->id],
                [
                    'name' => $request->name,
                    'type' => $request->type,
                    'value' => $request->value,
                    'minValue' => $request->minValue,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
