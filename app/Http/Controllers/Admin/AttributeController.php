<?php

namespace App\Http\Controllers\Admin;

use App\Models\Attribute;
use App\Models\AttributeValue;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    use ApiResponse;
    
    public function index_attribute_name(){
        $data = Attribute::get();
        return view('admin/Attribute.attributes', compact('data'));
    }

    public function store_attribute_name(Request $request){
        $validation = Validator::make($request->all(), [
            'name' => 'required|string|max:255',
            'slug'  => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            Attribute::updateOrCreate(
                ['id'=> $request->id],
                [
                    'name' => $request->name,
                    'slug' => $request->slug,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }

    public function index_attribute_value(){
        $data = AttributeValue::with('singleAttribute')->get();
        $attributes = Attribute::get();
        return view('admin/Attribute.attribute-values', get_defined_vars());
    }

    public function store_attribute_value(Request $request){
        $validation = Validator::make($request->all(), [
            'attribute_id'  => 'required|exists:attributes,id',
            'value' => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            AttributeValue::updateOrCreate(
                ['id'=> $request->id],
                [
                    'attribute_id'  => $request->attribute_id,
                    'value'         => $request->value,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
