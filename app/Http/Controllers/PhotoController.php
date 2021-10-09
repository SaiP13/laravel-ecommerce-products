<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use DB;

class PhotoController extends Controller
{
    public function index(){
        return view('photos.index');
    }
    public function getimages(){

        $photos = DB::table('photos')->select('*')->get();
        return view('photos.ajax-photos',['photos'=>$photos]); exit();
        // return response()->json(['photos'=>$photos]);
    }
    public function imageUpload(Request $request)
    {

        if($request->TotalImages > 0)
        {
           for ($x = 0; $x < $request->TotalImages; $x++)
           {
               if ($request->hasFile('images'.$x))
                {
                    $file = $request->file('images'.$x);
                    $name = $file->getClientOriginalName();
                    $file->move(public_path('sai/'), $name);
                    $insert[$x]['photo_name'] = $name;
                }
           }
            DB::table('photos')->insert($insert);
            return response()->json(['success'=>'Successfully Uploaded!']);
        }
        else
        {
           return response()->json(["message" => "Please try again."]);
        }
    }
}
