<?php

namespace App\Http\Controllers\Admin;

use App\Models\Size;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class SizeController extends Controller
{
    use ApiResponse;
    
    public function index(){
        $data = Size::get();
        return view('admin/Size.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'text'  => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            Size::updateOrCreate(
                ['id'=> $request->id],
                [
                    'text' => $request->text,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
