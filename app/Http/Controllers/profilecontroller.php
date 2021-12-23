<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rules\Password;
use Image;


class profilecontroller extends Controller
{
    function editprofile(){
        return view('admin.profile.index');
    }

function namechange(Request $request){
    $user_id= Auth::id();

    User::find($user_id)->update([
      'name'=>$request->name,
      'email'=>$request->email,
    ]);
    return back();
}


function passchange(Request $request){
    $request->validate([
        'old_password'=>'required',
        'password'=>'required',
        'password'=>'confirmed',
        'password'=>Password::min(8)
        ->letters()
        ->mixedCase()
        ->numbers(),


    ]);



    if(Hash::check($request->old_password, Auth::user()->password)){

        $user_id= Auth::id();

       User::find($user_id)->update([

          'password'=>bcrypt($request->password),
       ]);

       return back()->with('uppass', 'password updated');

    }

}

function photochange(Request $request){
   $request->validate([
    'profile_photo'=>'image',
    'profile_photo'=>'image|max:2000',
   ]);

if(Auth::user()->profile_photo != 'default.jpg'){
    $delete_path = public_path()."/uploads/profile/".Auth::user()->profile_photo;
    unlink($delete_path);
}



   $uploaded_photo_name = $request->profile_photo;
   $extension = $uploaded_photo_name->getClientOriginalExtension();
   $new_photo_name= Auth::id().'.'.$extension;

  Image::make($uploaded_photo_name)->save(base_path('public/uploads/profile/'.$new_photo_name));

  user::find(Auth::id())->update([
    'profile_photo'=>$new_photo_name,
  ]);


return back();

}

}
