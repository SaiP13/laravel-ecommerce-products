<?php

namespace App\Helpers;
use DB;

class Helper
{

    public static function check_wishlist($id)
    {
        $userid = session('userid');
        $result = DB::table('wishlist')->where('user_id',$userid)->where('product_id',$id)->first();
        return $result;
    }



}
