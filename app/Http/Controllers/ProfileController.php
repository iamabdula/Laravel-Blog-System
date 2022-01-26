<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Profile;
use App\User;

class ProfileController extends Controller
{
    //this function will show "Post View" which is basically post.blade.php file
    public function profile(){
        return view ('profiles.profile'); // since post.blade.php file is present in "posts" folder, so here we accessed it by using dot (.)
    }

    //this function will show "Post View" which is basically post.blade.php file
    public function addProfile(Request $request){
        $this->validate($request, [
            'name'=> 'required',
            'designation'=> 'required',
            'profile_pic'=> 'required'
            ]);
            $profiles = new Profile;
            $profiles->name = $request->input('name');
            $profiles->user_id=Auth::user()->id;
            $profiles->designation = $request->input('designation');
            if(Input::hasFile('profile_pic'))
            {
                $this->validate($request, [
                    'profile_pic'  => 'required| mimes:jpeg,jpg,png|max:2048'
                ]);
                $file = Input::file('profile_pic');
     $file->move(public_path().'/uploads/',$file->getClientOriginalName());
                
     $url = URL::to("/") . '/uploads/'. $file->getClientOriginalName();
                
            }
            $profiles->profile_pic = $url;
            $profiles->save();
            return redirect ('/home')->with('response', 'Profile Added Successfully');
    }
}
 