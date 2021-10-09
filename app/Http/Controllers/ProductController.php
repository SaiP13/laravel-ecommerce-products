<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use DB;
class ProductController extends Controller
{

    public function cartProducts(){
        return view('product.cart-products');
    }

    public function getCartItems(){
        $userid = session('userid');
        $products = \DB::table('cart_items as C')
                    ->join('products as P','p.id','=','c.product_id')
                    ->select('C.*','P.name','P.prod_img','P.price','P.description')
                    ->where('c.user_id',$userid)
                    ->get();
        return view('product.cart-ajax',['products'=>$products]);
    }
    public function getCartCount(){
        $userid = session('userid');
        $cart_count = DB::table('cart_items')->where('user_id',$userid)->count();
        return response()->json(['cart_count'=>$cart_count]);
    }

    public function removeCartItem(Request $request){

        $id = $request->id;
        $result = \DB::table('cart_items')->where('id', '=', $id)->delete();

        if($result){
            $data = "success";
            return $data;
        } else {
            $data = "failed";
            return $data;
        }

    }
    public function updateProductQuantity(Request $request){

        $id = $request->id;
        $data['quantity'] = $request->quantity;
        $result = \DB::table('cart_items')->where('id', '=', $id)->update($data);

        if($result){
            $data = "success";
            return $data;
        } else {
            $data = "failed";
            return $data;
        }

    }
    public function addToCart(Request $request){

        $this->validate($request,[
            'product_id' => 'required',
            'color' => 'required',
            'size' => 'required'
        ]);
        $prod['product_id'] = $request['product_id'];
        $prod['color'] = $request['color'];
        $prod['size'] = $request['size'];
        $prod['user_id'] = session('userid');
        $prod['datetime'] = date('Y-m-d H:m:s');

        $result = DB::table('cart_items')->insert($prod);

        if(isset($result)){
            $data = "success";
            return $data; exit();
        } else {
            $data = "failed";
            return $data; exit();
        }

    }
    public function add_wishlist(Request $request){

        $prod['product_id'] = $request['product_id'];
        $prod['user_id'] = session('userid');

        //$check = DB::table('wishlist')->where('user_id', $pro);
        $result = DB::table('wishlist')->insert($prod);

        if(isset($result)){
            $data = "success";
            return $data; exit();
        } else {
            $data = "failed";
            return $data; exit();
        }

    }
    public function remove_wishlist(Request $request){

        $prodid = $request['product_id'];
        $userid = session('userid');

        $result = DB::table('wishlist')->where('user_id',$userid)->where('product_id',$prodid)->delete();

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
            $imgName->move(public_path('images/'), $fileName);
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

            return redirect('products')->with('status','Product Updated Successfully!');;

        } else {
            return redirect()->back();
        }

    }
    public function productsAjax(Request $request){

        $key = $request->key;
        $color = $request->colors;
        $price = $request->price;

        $query = DB::table('products');
        if(isset($color)){
            $query->leftJoin('colors', 'products.id','=','colors.product_id')
            ->select('products.*')
            ->whereIn('colors.color', (explode(',',$color)))
            ->distinct();
        }
        if(isset($key)){
           $query->where('name','like','%'.$key.'%');
        }

        if(isset($price)){
            $query->whereBetween('price', [explode(',',$price)]);
        }

        $products = $query->get();

        //return response()->json($products);

        return view('product.products-ajax',['products'=>$products]); exit();
    }

}
