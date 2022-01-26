<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use App\Post;  
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Comment; 

use App\User;

class PostController extends Controller
{   
    //this function will show "Post View" which is basically post.blade.php file
    public function post(){
        return view ('posts.post'); // since post.blade.php file is present in "posts" folder, so here we accessed it by using dot (.)
    }
    // public function addPost(Request $request){
    //     $this->validate($request, [
    //         'post_title'=> 'required',
    //         'post_body'=> 'required',
    //         'post_image'=> 'required'
    //         ]);
    //         return("Validation Passed");
    // }
    public function addPost(Request $request){
        $this->validate($request, [
            'post_title'=> 'required',
            'post_body'=> 'required',
           // 'category_id'=> 'required',
            'post_image'=> 'required',
            ]);
            $posts = new Post;
            $posts->post_title = $request->input('post_title');
            $posts->user_id=Auth::user()->id;
            $posts->post_body = $request->input('post_body');
            $status= 0;
            if(Auth::User()-> id ==1){
                $status=1;
            }
            $posts->status=$status;
         //   $posts->category_id = $request->input('category_id');
            if(Input::hasFile('post_image')){
                $this->validate($request, [
                    'post_image'  => 'required| mimes:jpeg,jpg,png|max:2048'
                ]);
                $file = Input::file('post_image');
                $file->move(public_path().'/uploads',$file->getClientOriginalName());
                $url = URL::to("/") . '/uploads/'.$file->getClientOriginalName();
            }
            $posts->post_image = $url;
            $posts->save();
            return redirect ('/home')->with('response', 'Post Created Successfully');
    }
    public function view($post_id)
    {
        $posts = Post::where ('id','=',$post_id)->get();
         

          $comments= DB::table ('users')
                ->join ('comments', 'users.id','=', 'comments.user_id' )
                ->join ('posts', 'comments.post_id','=', 'posts.id' )
                
                ->select('users.name','comments.*')
                ->where(['posts.id' => $post_id])
                ->get();
              
                return view ('posts.view',['posts'=> $posts, 'comments'=> $comments ]);

    }

    public function edit($post_id){
        // $categories = Category::all();
        $posts = Post::find($post_id);
        // $category = Category::find($posts->category_id);
        return view('posts.edit',['posts' =>$posts]);
    }
    public function editPost(Request $request, $post_id){
     
        $this->validate($request, [
            'post_title'=> 'required',
            'post_body'=> 'required',
            // 'category_id'=> 'required',
            'post_image'=> 'required',
            ]);
            $posts = new Post;
            $posts->post_title = $request->input('post_title');
            $posts->user_id=Auth::user()->id;
            $posts->post_body = $request->input('post_body');
            // $posts->category_id = $request->input('category_id');
            if(Input::hasFile('post_image')){
                $this->validate($request, [
                    'post_image'  => 'required| mimes:jpeg,jpg,png|max:2048'
                ]);
                $file = Input::file('post_image');
                $file->move(public_path().'/uploads',$file->getClientOriginalName());
                $url = URL::to("/") . '/uploads/'.$file->getClientOriginalName();
            }
            $posts->post_image = $url;
            $data = array(
                'post_title' => $posts->post_title,
                'user_id' => $posts->user_id,
                'post_body' => $posts->post_body,
                // 'category_id' => $posts->category_id,
                'post_image' => $posts->post_image
            );
            Post::where('id',$post_id)
                ->update($data);
            $posts->update();
            return redirect ('/home')->with('response', 'Post Updated Successfully');
    }
    public function deletPost($post_id) 
    {
        Post::WHERE ('id',$post_id)
        ->delete();
        return redirect ('/home')->with('response', 'Post Deleted Successfully');
    }

    public function comment(Request $request, $post_id)
    {
        $this->validate($request, [
            'comment'=> 'required'
            ]);
            $comment =  new Comment;
            $comment -> user_id =Auth::user()->id;
            $comment -> post_id =$post_id;    
            $comment->comment= $request->input('comment');
            $comment->save();
            return redirect ("/view/{$post_id}")->with('response','Comment Added Successfully');

    }
    public function approvePost($post_id) 
    {
       
        // return view('');
        $posts = Post::where ('id','=',$post_id)->get();
        $users = USER::all();
        
        $comments= DB::table ('users')
              ->join ('comments', 'users.id','=', 'comments.user_id' )
              ->join ('posts', 'comments.post_id','=', 'posts.id' )
              
              ->select('users.name','comments.*')
              ->where(['posts.id' => $post_id])
              ->get();
            
              return view ('posts.approvePost',['posts'=> $posts, 'comments'=> $comments ,'users'=>$users ]);





        
    }

    public function publishPost($post_id)
    {
        $posts = new Post;
        $posts-> status=1;

        $data = array(
            'status' => $posts->status
        );
        Post::where('id',$post_id)
                ->update($data);
        $posts->update();
        return redirect ('/home')->with('response', 'Post Updated Successfully');
    }

}

