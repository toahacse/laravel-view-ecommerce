<?php
 
namespace App\Traits;
use Illuminate\Support\Facades\File;

trait SaveFile
{
    protected function saveFile($file, $prevImage='', $path='', $table='', $id='') {
        if($table != ''){
            $image = DB::table(''.$table.'')->where('id', $id)->first();

            $image_path = "images/".$image->image."";
            if(File::exists($image_path)){
                File::delete($image_path);
            }
        }
        $image_name = time().'.'.$file->extension();
        if( $path == ''){
            $file->move(public_path('images/'), $image_name);
        }else{
            $file->move(public_path(''.$path.'/'), $image_name);
        }

        return $image_name;
    }
}