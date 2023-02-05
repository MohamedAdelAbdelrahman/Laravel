<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use App\Models\Post;
use App\Models\User;
use App\Models\Comment;
use Illuminate\Support\Facades\Storage;
use App\http\Requests\StorePostRequest;




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
        return view('posts.create',['users' => $users,]);
    }

    //*store
    public function store(StorePostRequest $request){

        $data = $request->all();
        $title = $data['title'];
        $description = $data['description'];
        $userId = $data['post_creator'];

        $image_path = null;
        if ($request->hasFile('image')) {
            $postImage = $request->file('image');
            $image_path = $postImage->store('images');
        }


        Post::create([
            'title'=>$title,
            'description'=>$description,
            'user_id'=>$userId,
            'image_path' => $image_path,
        ]);

        return to_route('posts.index');

        $this->validate($request, [
            'image' => 'required|image|mimes:jpg,png,jpeg,gif,svg|max:2048',
        ]);

        $image_path = $request->file('image')->store('image', 'public');

        $data = Post::create([
            'image' => $image_path,
        ]);

        session()->flash('success', 'Image Upload successfully');

        return redirect()->route('posts.index');
    
    }
 

    //*show
    public function show($postId){
        
        $comments = Comment::where('post_id', $postId)->get();
        $allPosts = Post::find($postId);
        return view('posts.show', [
            'post' => $allPosts,
            'comments' => $comments
        ]);
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

            if ($request->hasFile('image')) {
                Storage::delete($allPosts->image_path);
                $postImage = $request->file('image');
                $image_path = $postImage->store('images');
                $allPosts->image_path = $image_path;
            } elseif (isset($request->delete_image)) {
                Storage::delete($allPosts->image_path);
                $image_path = '';
                $allPosts->image_path = $image_path;
            }

    }

    //*delete
    public function destroy($postId){
            $allPosts = Post::find($postId);
            if(!$allPosts) {return to_route(route: 'posts.index');}

            $postComments = Comment::where('id', $postId)->get();
            $postComments->each->delete();
    
            Storage::delete($allPosts->image_path);

            $allPosts->delete();
            return redirect()->route('posts.index');
            }

}
