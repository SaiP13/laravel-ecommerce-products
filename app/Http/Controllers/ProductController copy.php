<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
class ProductController extends Controller
{

    public function add_wishlist(Request $request){

        $prod['product_id'] = $request['product_id'];
        $prod['user_id'] = sesion('userid');

        $result = DB::table('wishlist')->insert($prod);

        if(isset($result)){
            $data = "success";
            return $data; exit();
        } else {
            $data = "failed";
            return $data; exit();
        }

    }
    public function products(){

        $colors = DB::table('colors')->select('color')->distinct()->get();

        $price['min'] = DB::table('products')->min('price');
        $price['max'] = DB::table('products')->max('price');
        //dd($data);

        return view('product.products',['colors'=>$colors,'price'=>$price]);
    }
    public function productView($id){

        $product = DB::table('products')->where('id',$id)->first();
        $images = DB::table('product_images')->where('product_id',$id)->get();
        return view('product.product-view',['product'=>$product,'images'=>$images]);
    }
    public function deleteProduct($id){

        $delete = DB::table('products')->where('id',$id)->delete();
        if($delete){
            return redirect('products')->with('status','Product Deleted Successfully!');;
        } else {
            return redirect()->back();
        }
    }
    public function addProduct(){
        return view('product.add-edit');
    }
    public function editProduct($id){
        $product = DB::table('products')->where('id',$id)->first();
        return view('product.add-edit')->with('product',$product);
    }
    public function storeProduct(Request $request){

        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'discount_price'=>'required',
            'quantity'=>'required',
            'description'=>'required',
            'prod_img' => 'required|image'
        ]);

        $inputs = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            // 'colors' => implode(',',$request->color),
            'sizes' => implode(',',$request->sizes)
        ];

        if($request->hasFile('prod_img')) {

            $imgName = $request->file('prod_img');
            $fileName = time().'.'.$imgName->getClientOriginalExtension();
            $destinationPath = public_path('images/');
            $imgName->move($destinationPath, $fileName);
            $inputs['prod_img'] = $fileName;

        }


        $insertResult = Product::insertProduct($inputs);

        if(isset($insertResult)){

            foreach($request->file('multi_img') as $file)
            {
                $name = time().rand(1,100).'.'.$file->extension();
                $file->move(public_path('IMAGES/'), $name);
                $img['prod_image'] = $name;
                $img['product_id'] = $insertResult;
                \DB::table('product_images')->insert($img);
            }
            foreach($request->color as $c)
            {
                $color['color'] = $c;
                $color['product_id'] = $insertResult;
                \DB::table('colors')->insert($color);
            }

            return redirect('products')->with('status','Product added successfully!');

        } else {
            return redirect()->back();
        }

    }
    public function updateProduct(Request $request,$id){

        $this->validate($request,[
            'name'=>'required',
            'price'=>'required',
            'discount_price'=>'required',
            'quantity'=>'required',
            'description'=>'required',
        ]);

        $inputs = [
            'name' => $request->name,
            'price' => $request->price,
            'quantity' => $request->quantity,
            'discount_price' => $request->discount_price,
            'description' => $request->description,
            'colors' => implode(',',$request->color),
            'sizes' => implode(',',$request->sizes)
        ];

        if($request->hasFile('prod_img')) {

            $imgName = $request->file('prod_img');
            $fileName = time().'.'.$imgName->getClientOriginalExtension();
            $destinationPath = public_path('images/');
            $imgName->move($destinationPath, $fileName);
            $inputs['prod_img'] = $fileName;

        }


        $insertResult = DB::table('products')->where('id',$id)->update($inputs);

        if(isset($insertResult)){
            // if(!empty($request->file('multi_img'))){
            //     foreach($request->file('multi_img') as $file)
            //     {
            //         $name = time().rand(1,100).'.'.$file->extension();
            //         $file->move(public_path('IMAGES/'), $name);
            //         $img['prod_image'] = $name;
            //         $img['product_id'] = $insertResult;
            //         \DB::table('product_images')->insert($img);
            //     }
            // }
            return redirect('products')->with('status','Product Updated Successfully!');;

        } else {
            return redirect()->back();
        }

    }
    public function productsAjax(Request $request){

        $key = $request['key'];

        if(empty($key)){
            $products = DB::table('products')->select('*')->get();
            // $products = DB::table('products')->paginate(3);
            return view('product.products-ajax',['products'=>$products]);

        } else {
            $products = DB::table('products')->where('name','like','%'.$key.'%')->get();
            return view('product.products-ajax',['products'=>$products]);
        }


    }
    //colors
    public function colorProductsAjax(Request $request){

        $color = $request['color'];

        // $products = DB::table('products')->where('colors','like','%'.$color.'%')->get();
        // $Products = DB::table('products')->whereIN('colors', (explode( ',', $color ))  )->get();

        $products = DB::table('products')
                    ->leftJoin('colors', 'products.id','=','colors.product_id')
                    ->select('products.*')
                    ->whereIn('colors.color', (explode(',',$color)))
                    ->distinct()
                    ->get();
        if($products != ""){
            return view('product.products-ajax',['products'=>$products]); exit();
        } else {
            $data = "";
            return $data;
        }


    }
    //prices
    public function priceProductsAjax(Request $request){

        $price = $request['price'];

        if($price != ""){

            $products = DB::table('products')->select('*')->whereBetween('price', [explode(',',$price)])->get();
            return view('product.products-ajax',['products'=>$products]); exit();

        }

        // if($price == 500){

        //     $products = DB::table('products')->select('*')->where('price', '<=', $price)->get();
        //     return view('product.products-ajax',['products'=>$products]);

        // } else if($price == 1000){

        //     // $products = DB::table('products')->select('*')->where('price', '<=', 500)->get();
        //     $products = DB::table('products')->select('*')->whereBetween('price', [500,1000])->get();
        //     return view('product.products-ajax',['products'=>$products]);

        // }  else {
        //     $products = DB::table('products')->select('*')->get();
        //     return view('product.products-ajax',['products'=>$products]);
        // }



    }
}
