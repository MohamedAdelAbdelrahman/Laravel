<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Comment;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;

class PostController extends Controller
{
    public function index()
    {
        // $allPosts = Post::with('user')->all();
        //select * from posts;
        $allPosts = Post::paginate(5);
        return view('posts.index',[
            'posts' => $allPosts,
        ]);
    }

    public function create()
    {
        $users = User::get();

        return view('posts.create',[
            'users' => $users,
        ]);    }

    public function store(StorePostRequest $request)
    {
        // image
        $image_path = $request->file('image')->store('image', 'public');
        // return 'insert in database';
        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        Post::create([
            'title' => $title,
            'description' => $description,
            'user_id' =>$request->userId,
            'image' => $image_path,
        ]);
        session()->flash('success', 'Image Upload successfully');

              return redirect('/posts') ;

    }

    public function show($postId)
    {
        $allComments = Comment::all();
        $users = User::get();
        $post = Post::find($postId);
        return view('posts.show',[
            'posts'=> $post,
            'users' => $users,
            'comments' => $allComments,
             'id' => $postId
        ]);
    }
    public function edit($id )
    {
        $users = User::get();
        $post = Post::find($id);
        return view('posts.edit',[
            'posts'=> $post,
            'users' => $users,

        ]);
    }
    public function update($id ,StorePostRequest $request)
    {
        $image_path = $request->file('image')->store('image', 'public');
        $post = Post::find($id);
        $post->update([
            'title' =>$request->title,
            'description' =>$request->description,
            'user_id' =>$request->userId,
            'image'=>$image_path

        ]);
        return redirect('/posts') ;

    }

    public function destroy($id)
    {
        $post = Post::find($id);
        $post->delete();

        return redirect('/posts') ;


    }

}