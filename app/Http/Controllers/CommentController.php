<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use Illuminate\Support\Facades\Auth;

class CommentController extends Controller
{
    public function store(Request $request)
    {
        // always make a request to validate
        // $request->validate([
        //     'text' => ['required'],
        //     'postId' => ['required', 'exists:posts,id'],
        // ]);
        $data = request()->all(); //insted of using $_POST 
        $comment = $data['text'];
        $post_id = $data['post_id'];
        Comment::create([
            'text' => $comment,
            'post_id' => $post_id,
            'user_id' => Auth::user()->id,
        ]);
        return redirect()->route('posts.show', $post_id);
    }

    public function destroy($commentId)
    {
        $UserComment = Comment::find($commentId);

        if (!$UserComment) {
            return to_route(route: 'posts.index');
        }

        $post_id = $UserComment['post_id'];
        $UserComment->delete();

        return redirect()->route('posts.show', $post_id);
    }
}