<?php

namespace App\Http\Controllers\Admin;

use App\Models\Tax;
use App\Traits\ApiResponse;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Validator;

class TaxController extends Controller
{
    use ApiResponse;
    
    public function index(){
        $data = Tax::get();
        return view('admin/Tax.index', compact('data'));
    }

    public function store(Request $request){
        $validation = Validator::make($request->all(), [
            'text'  => 'required|string|max:255',
            'id'    => 'required|string|max:255',
        ]);

        if($validation->fails()){
            return $this->error($validation->errors()->first(), 400, []);
        }else{
            Tax::updateOrCreate(
                ['id'=> $request->id],
                [
                    'text' => $request->text,
                ]
            );

            return $this->success(['reload'=>true],'Successfully Update');
        }
    }
}
