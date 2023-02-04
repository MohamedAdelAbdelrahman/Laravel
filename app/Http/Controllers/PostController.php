<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use App\Models\Post;
use App\Http\Requests\StorePostRequest;



//*index
class PostController extends Controller
{
    public function index(){
        {
            $allPosts = Post::paginate(5);
            

            return view('posts.index',[
            'posts' => $allPosts,
        ]);
        }
    }
    //*create

    public function create(){
        $users = User::get();
        return view('posts.create',[
            'users' => $users,
        ]);
    }

    //*store
    public function store(StorePostRequest $request){


        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$userId,
        ]);

        return to_route('posts.index');
    }

    //*show
    public function show($postId){
        
        $allPosts = Post::find($postId);
        
        return view('posts.show',['post'=>$allPosts]);
    }

    //*edit
    public function edit($postId)
    {
        $users = User::get();
        $allPosts = Post::find($postId);

        return view('posts.edit',['post'=>$allPosts, 'users'=>$users]);
    }
    //*update

    public function update($postId, Request $request)
     { 
        $allPosts = Post::find($postId);
        if(!$allPosts) {
            return to_route(route: 'posts.index');}
            $allPosts->title = $request->title;
            $allPosts->description = $request->description;
            $allPosts->user_id = $request->posted_at;
            $allPosts->save();
            return to_route(route: 'posts.index');

    }

    //*delete
    public function destroy($postId){
            $allPosts = Post::find($postId);
            if(!$allPosts) {return to_route(route: 'posts.index');}
            $allPosts->forceDelete();
            return redirect()->route('posts.index');
            }

}
