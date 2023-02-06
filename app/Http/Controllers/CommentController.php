<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Comment;
use App\Models\Post;


class CommentController extends Controller
{
    public function store(Request $request ,$id)
    {


        $comment = new Comment();
        $comment->comment_body = $request->comment;
        $comment->post_id =$id ;
        $comment->user_id =$id ;
        $comment->save();
              return redirect()->back() ;

    }
    public function destroy($id)
    {
        $comment = Comment::find($id);
        $comment->delete();
        return redirect()->back() ;
    }

}