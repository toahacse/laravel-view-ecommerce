<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\HomeBanner;
use Illuminate\Http\Request;

class HomeBannerController extends Controller
{
    public function index(){
        $data = HomeBanner::get();
        return view('admin/HomeBanner.index', compact('data'));
    }
}
