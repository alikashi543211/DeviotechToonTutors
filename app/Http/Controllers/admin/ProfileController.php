<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Hash;

class ProfileController extends Controller
{
    public function profile()
    {
    	return view("admin.profile.profile",get_defined_vars());
    }
    public function logOut(){
        Auth::logout();
        return redirect('/login');
    }
    public function resetPassword(Request $request){
       
        $user = Auth::user();
        $id = Auth::id();
        $password = User::where('id', $id)->value('password');

        $this->validate($request, [
            'oldpassword'          => 'required',
            'newpassword'              => 'required|min:8',
            'confirm_password' =>'required|same:newpassword'
        ]);
        if (Hash::check($request->oldpassword, $password)) {
            //add logic here
           
        $user->password = Hash::make($request->newpassword);
        $user->save();
        // logout after changing password
        Auth::logout();
        return redirect('/login')->with('message','password changed successfully');
        }
        else{
            return redirect()->back()->with('message','Incorrect Old Password');
        }
    }
    public function update_Profile(Request $request){
       
        $user = Auth::user();
        $id = Auth::id();
        // $password = DB::table('users')->where('id', $id)->value('password');

        $user =  User::find($id);
        $old_email=$user->email;
        $user->name = $request->name;
        $user->email = $request->email;
        $user->save();
        Auth::logout();
        return redirect('/login')->with('message','Credentials changed successfully,please use new credentials to SignIn');
        
    }
}
