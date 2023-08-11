<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
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

     $user->name = $request->name;
     $user->email = $request->email;
     $user->phone = $request->phone;
     if($request->file('photo')){
        if(!empty($user->photo)){
            Storage::delete('upload/admin_images/'.$user->photo);
        }
       $file = $request->file('photo');
       $file_name = date('YmdHi').$file->getClientOriginalName();
       $file->move(public_path('upload/admin_images'),$file_name);
       $user->photo =  $file_name;
     }

     $user->save();
     return redirect()->back();

    }

    public function AdminLogout(Request $request){
        Auth::guard('web')->logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        return redirect('admin/login');
    }


    

}
