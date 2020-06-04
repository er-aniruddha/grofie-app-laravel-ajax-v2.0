<?php

namespace Grofie\Http\Controllers\apps;

use Illuminate\Http\Request;
use Grofie\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Grofie\Cart;
use Grofie\User;
use Session;
class AccountController extends Controller
{
	public function __construct()
    {
        $this->middleware('auth:apps');
    }
    public function index()
    {
    	$i = Cart::where('user_id' , Auth::id())->count();
        $user = User::find(Auth::id());          
    	return view('apps.account.account',['i' => $i , 'user' => $user]);
    }
    public function edit(Request $request)
    {
        $user = User::find($request->user_id);
        if($user->email == $request->email)
        {
            $validator = \Validator::make($request->all(), [
              'f_name' => 'required|max:255',
              's_name' => 'required|max:255',  
              'email' => 'required|max:255|email',
              ],[
                'f_name.required' => 'Please enter First name',
                's_name.required' => 'Please enter Surname',
                'email.required' => 'Please enter email id',
            ]); 
            if ($validator->fails())
            {
                return response()->json(['errors' => $validator->errors()]);
            }  
        }
        else
        {
            $validator = \Validator::make($request->all(), [
              'f_name' => 'required|max:255',
              's_name' => 'required|max:255',  
              'email' => 'required|max:255|email|unique:users,email',
              ],[
                'f_name.required' => 'Please enter First name',
                's_name.required' => 'Please enter Surname',
                'email.required' => 'Please enter email id',
            ]); 
            if ($validator->fails())
            {
                return response()->json(['errors' => $validator->errors()]);
            }  
        }

        $user->f_name = $request->f_name;
        $user->s_name = $request->s_name;
        $user->email = $request->email;
        $user->update();
        $tmessage = array('tmessage' => 'Your information updated successfully');  
        return response()->json(['success' => 1, 'tmessage' => $tmessage]);       
    }
}
