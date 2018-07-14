<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Image;
use Validator;

class UploadController extends Controller
{
    public function upload(Request $request){

        $validator = Validator::make($request->file(), [
            'file' => 'required|mimes:jpeg,bmp,png,gif,pdf|max:1024'
        ]);

        if($validator->passes()){

            $file = $request->file('file');
            $tmp_name = $file->getPathname();
            $extension = $file->getClientOriginalExtension();
            $mime_type = $file->getMimeType();
            $dir = public_path('images').'/doc/';
            $filename = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $src = '/images/doc/'.$filename;

            if($mime_type == 'application/pdf') {
                $file->move($dir, $filename);
            }else{
                Image::make($tmp_name)->resize(700, 1000)->save($dir . $filename);
            }

            return response()->json(['src'=> $src, 'type'=>$tmp_name]);
        }
        return response()->json(['error'=>$validator->errors()->all()]);
    }
}
