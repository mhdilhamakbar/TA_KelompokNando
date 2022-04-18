<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Hash;
use Auth;
use Validator;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
    public function cpPage(){
        return view('auth.change_pass');
    }
    public function confirmChange(Request $request){
        $user = Auth::user();
        $req = $request->all();
        $validator = Validator::make($req,[
            'password' => ['required', 'string', 'min:8', 'required_with:c_password', 'same:c_password'],
            'c_password' => ['min:8'],
        ]);
        if($validator->fails()){
            return redirect()->back()->with('error',"Password must be the same and min 8 characters.");
        }
        User::where('id',$user->id)->update([
            'password' => Hash::make($req['password'])
        ]);
        return redirect()->back()->with('success','Password Changed');
    }

}
