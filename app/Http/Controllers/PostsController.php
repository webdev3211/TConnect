<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use App\post;

class PostsController extends Controller
{

public function index(){
    $posts = DB::table('posts')->get();
    return view('posts',compact('posts'));
}

public function search(Request $request){
    $qry = $request->qry;
    return $users = DB::table('users')
    ->where('name', 'like','%'.$qry.'%')
    ->get();
}

public function addPost(Request $request){

    $content = $request->content;
    $createPost = DB::table('posts')
    ->insert([
        'content' => $content,
        'user_id' => Auth::user()->id,
        'status'  => 0,
        'created_at' =>\Carbon\Carbon::now()->toDateTimeString(),
        'updated_at' => \Carbon\Carbon::now()->toDateTimeString()
    ]);

    if($createPost){
        // $posts_json = DB::table('users')
        // ->rightJoin('profiles', 'profiles.user_id', 'users.id')
        // ->rightJoin('posts', 'posts.user_id' ,'users.id' )
        // ->orderBy('posts.created_at', 'desc')->take(5)
        // ->get();

        // return $posts_json;
        return post::with('user', 'likes' ,'comments' )
        ->orderBy('created_at', 'DESC')
        ->get();

        
    }

}



public function deletePost($id){
    $deletePost = DB::table('posts')
    ->where('id', $id)->delete();

    if($deletePost){
        // $posts_json = DB::table('users')
        // ->rightJoin('profiles', 'profiles.user_id', 'users.id')
        // ->rightJoin('posts', 'posts.user_id' ,'users.id' )
        // ->orderBy('posts.created_at', 'desc')->take(5)
        // ->get();
    
        // return $posts_json;
        return post::with('user', 'likes', 'comments')
        ->orderBy('created_at', 'DESC')
        ->get();
    
    }


}


public function likePost($id){
    $likePost = DB::table('likes')->insert([
        'posts_id' => $id,
        'user_id' => Auth::user()->id,
        'created_at' => \Carbon\Carbon::now()->toDateTimeString(),

    ]);

    //if like successfuly then display post
    if($likePost){
        return post::with('user', 'likes', 'comments')->orderBy('created_at', 'DESC')->get();
    }

}

    public function addComment(Request $request){
        $comment = $request->comment;
        $id = $request->id;
        $createComment= DB::table('comments')
        ->insert([
            'comment' =>$comment,
            'user_id' => Auth::user()->id,
            'posts_id' => $id,
            'created_at' =>\Carbon\Carbon::now()->toDateTimeString(),
            'user_name' => Auth::user()->name,
            'user_pic' => Auth::user()->pic
        ]);
        if($createComment){
            return post::with('user','likes','comments')->orderBy('created_at','DESC')
            ->get();
        }

    }
    
    public function saveImg(Request $request){
        $img = $request->get('image');

        //remove extra parts
        $exploded = explode(",", $img);

        //extension
        if(str_contains($exploded[0], 'gif')){
            $ext = 'gif';
        } else if(str_contains($exploded[0], 'png')){
            $ext = 'png';
        } else if(str_contains($exploded[0], 'jpg')){
            $ext = 'jpg';
        } else{
            $ext = 'jpeg';
        }

        //decode 
        $decode = base64_decode($exploded[1]);

        $filename = str_random().".".$ext;
        //path of your local folder
        $path = public_path()."/img/".$filename;

        //upload the image to your path
        if(file_put_contents($path, $decode)){

        $content = $request->content;
        $createPost = DB::table('posts')
        ->insert([
            'content' => $content,
            'user_id' => Auth::user()->id,
            'status'  => 0,
            'created_at' =>\Carbon\Carbon::now()->toDateTimeString(),
            'updated_at' => \Carbon\Carbon::now()->toDateTimeString(),
            'image' => $filename,
        ]);
    
        if($createPost){
    
            return post::with('user', 'likes' ,'comments' )
            ->orderBy('created_at', 'DESC')
            ->get();
    
            
        }
    

        }

    }



}
