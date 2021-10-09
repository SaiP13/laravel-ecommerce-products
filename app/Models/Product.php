<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use DB;

class Product extends Model
{
    // use HasFactory;
    protected $table = 'products';

    public static function insertProduct($data){
        return DB::table('products')->insertGetId($data);
    }
}
