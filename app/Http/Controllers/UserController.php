<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\UserModel;
use DB;
class UserController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    // public function __construct()
    // {
    //     $this->middleware('check');
    // }

    public function checkWishList(Request $request){

        $id = $request->id;
        $userid = session('userid');
        $result = DB::table('wishlist')->where('user_id',$userid)->where('product_id',$id)->first();

        if(!empty($result)){
            $res = "success";
            return $res;
        } else {
            $res = "failed";
            return $res;
        }

    }
    public function wishList()
    {
        $products = DB::table('wishlist as W')
                    ->join('products as P','P.id','W.product_id')
                    ->select('P.*')->get();
        return view('product.wishlist-ajax',['products'=>$products]);
    }
    public function getwishListItems()
    {
        $products = DB::table('wishlist as W')
                    ->join('products as P','P.id','W.product_id')
                    ->select('P.*')->get();
        return view('product.wishlist-products',['products'=>$products]);
    }
    public function index()
    {
        $users = UserModel::getUsers();
        return view('users.index',['users'=>$users]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('user.insert-edit');

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'required',
            'email' => 'required|email|unique:customers',
            'password'=> 'required',
            'confirm_password' => 'required|same:password',

        ]);
        $data = $request->except('_token','confirm_password');
        $data['password'] = \Hash::make($request->password);

        $insertResult = DB::table('customers')->insert($data);

        if($insertResult){
            return redirect('/login')->with('status', 'User created!');
        } else{
            return redirect('signup')->with('status', 'Failed! try again');;
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $user = UserModel::findOrFail($id);
        return view('users.insert-edit')->with('user',$user);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        $this->validate($request,[
            'name' => 'required',
            'gender' => 'required',
            'dob'=> 'required',
            'role'=> 'required'
        ]);
        //$data = $request->except('_token','confirm_password');

        // $data['name'] = $request['name'];
        // $data['gender'] = $request['gender'];
        // $data['dob'] = $request['dob'];
        // $data['role'] = $request['role'];

        $input = [
            'name'=> $request->name,
            'gender'=> $request->gender,
            'dob'=> $request->dob,
            'role'=> $request->role
        ];
        if(!empty($request->password)){
            $input['password'] = \Hash::make($request->password);
        }

        $update = UserModel::updateUser($id,$input);

        if(isset($update)){
            return redirect('users')->with('status', 'User Updated!');
        } else{
            return redirect('/edit',$id)->with('status', 'Failed! try again');;
            //return "failed";
        }

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $result = UserModel::deleteUser($id);
        if($result){
            return redirect('users')->with('status', 'User Updated!');
        } else{
            return view('edit',$id)->with('status', 'Failed! try again');;
        }
    }
}
