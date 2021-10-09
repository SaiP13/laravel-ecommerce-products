<?php

namespace App\Http\Controllers;
use App\Models\UserModel;
use Illuminate\Http\Request;
use DB;
use Illuminate\Support\Facades\Auth;
use Session;

class LoginController extends Controller
{

    public function login()
    {
        //Session::put('product_id',$id);
        return view('login');
    }
    public function Wishlogin($id)
    {
        Session::put('product_id',$id);
        return view('login');
    }

    public function loginAction(Request $request){

        $this->validate($request,[
            'username'=> 'required',
            'password'=> 'required',
        ]
        );
        $mail = $request['username'];
        $password = $request['password'];

        $user = DB::table('customers')
                ->where('email',$mail)
                ->orWhere('name',$mail)
                ->first();

        if(!empty($user) && \Hash::check($password, $user->password)){
            $request->session()->put('userid', $user->id);
            $request->session()->put('username', $user->name);

            $request->session()->flash('status', "Login successs");

            if(session('product_id')){

                $prod['product_id'] = session('product_id');
                $prod['user_id'] = session('userid');

                $resultWish = DB::table('wishlist')->insert($prod);
                if($resultWish){
                    $request->session()->flash('status', "Successfully added!");
                    return redirect('products');
                    Session::flush('product_id');
                } else {
                    $request->session()->flash('status', "Failed!");
                    return redirect('products');
                }

            } else {
                return redirect('products');
            }
        } else {
            $request->session()->flash('status', "Invalid User");
            return redirect('/login');
        }
    }
    public function ajaxLogin(Request $request){
        $mail = $request['email'];
        $password = $request['password'];
        $user = DB::table('customers')
                ->where('email',$mail)
                ->orWhere('name',$mail)
                ->first();

        if(!empty($user) && \Hash::check($password, $user->password)){
            $request->session()->put('userid', $user->id);
            $request->session()->put('username', $user->name);
            return "success";
        } else {
            return "failed";
        }
    }

    public function logout(){
        // $request->session()->flush();
        \Session::flush();
        return redirect('/products');
    }
}
