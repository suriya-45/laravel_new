<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Storage;

class AdminController extends Controller
{
    
    public function dashboard(){
        return view('admin.index');
    }

    public function AdminLogin(Request $request){
        return view('admin.admin_login');
    }

    public function AdminProfile(){

        $id = Auth::user()->id;
        $profile = User::find($id);
        return view('admin.profile_view',compact('profile'));
    }



    public function AdminProfilestore(Request $request){
        // dd($request);
     $id = Auth::user()->id;
     $user = User::find($id);

     $request->validate([
       'username'=>'required',
       'name'=>'required',
       'email'=>'required|email',
       'phone'=>'required|numeric',

     ]);

     $user->name = $request->name;
     $user->username = $request->username;
     $user->email = $request->email;
     $user->phone = $request->phone;
     if($request->file('photo')){
        if(!empty($user->photo)){
            if(file_exists(public_path('upload/admin_images/'.$user->photo))){
                @unlink(public_path('upload/admin_images/'.$user->photo));
            }
            Storage::delete(public_path());
        }
       $file = $request->file('photo');
       $file_name = date('YmdHi').$file->getClientOriginalName();
       $file->move(public_path('upload/admin_images'),$file_name);
       $user->photo =  $file_name;
     }

     if($user->save()){
      toastr()->success('Profile Updated Successfully!');
     }else{
        toastr()->error('Profile Updated Failed!');
     }
     return back();

    }


    public function AdminChangepassword(){

        $id = Auth::user()->id;
        $user = User::find($id);
       return view('admin.change_password',['profile'=>$user]);
        
    }

    public function AdminSavepassword(Request $request){

     $request->validate([
      'old_password'=>'required',
      'new_password'=>'required|different:old_password',
      'confirm_password'=>'required|same:new_password',

     ]);
     
     $id = Auth::user()->id;
     $user = User::find($id);
     $old_password = $request->old_password;
      if(!Hash::check($old_password, $user->password)){
        toastr()->error('Your Old Password is incorrect!');
        return back();
      }
     $user->password = Hash::make($request->new_password);
     if($user->save()){
        toastr()->success('Password Changed Successfully');
     }else{
        toastr()->error('Password Changed Failed');
     }
     return back();
         
     }


    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }


    

}
