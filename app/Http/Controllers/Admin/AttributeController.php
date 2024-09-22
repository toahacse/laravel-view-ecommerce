<?php

namespace App\Http\Controllers\Admin;

use App\Models\Color;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class AttributeController extends Controller
{
    use ApiResponse;
    
    public function index(){
        $data = Color::get();
        return view('admin/Color.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'value' => 'required|string|max:255',
            'text'  => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            Color::updateOrCreate(
                ['id'=> $request->id],
                [
                    'text' => $request->text,
                    'value' => $request->value,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
