<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Profile;
use App\User;
use App\Post;
use Auth;

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
     * @return \Illuminate\Http\Response
     */
    public function index()
    {   
        $user_id = Auth::user() -> id;
        $profile= DB::table ('users')
                ->join ('profiles', 'users.id','=', 'profiles.user_id' )
                ->select('users.*','profiles.*')
                ->where(['profiles.user_id' => $user_id])
                ->first();
        $posts  = Post::all();
   
        return view('home',['profile' => $profile, 'posts' => $posts,'user_id' => $user_id]);
    }

    public function Admin(){
        $users = User::all();
        $posts  = Post::all();
        

        // var_dump ($users);exit;
        return view('posts.admin',["users" => $users , 'posts' => $posts]  );
    }

    public function editUser($user_id){
        // $categories = Category::all();
        $users = User::find($user_id);
        $profiles = Profile::where('id',$user_id);
        // $category = Category::find($posts->category_id);
        return view('user.edit',['users' =>$users, 'profiles' => $profiles]);
    }

    public function updateUser(Request $request, $user_id){
     
        $this->validate($request, [
            'name'=> 'required',
            'email'=> 'required',    
            ]);
            $users = new User;
            $users->name = $request->input('name');            
            $users->email = $request->input('email');        
            $data = array(
                'name' => $users->name,
                'email' => $users->email,            
            );
            User::where('id',$user_id)
                ->update($data);
            $users->update();
            return redirect ('/home')->with('response', 'User Updated Successfully');
    }

    public function deleteUser($user_id) 
    {
        User::WHERE ('id',$user_id)
        ->delete();
        return redirect ('/home')->with('response', 'User Deleted Successfully');
    }

    public function approvePost($post_id) 
    {
        $posts  = Post::find($post_id);

        $profiles = Profile:: all();
        return view('posts.approvePost',['profiles' => $profiles, 'posts' => $posts]);
        // return view('');
    }
}
