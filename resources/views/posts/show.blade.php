@extends('layouts.app')

@section('title') create @endsection
@section('content')
<style>
  body{
      background-color: rgb(8, 66, 113);
      font-weight: bold;
  }
</style>
<div class="text-end">
  <a href="{{route('posts.index')}}" class="mt-4 btn btn-primary">Go Back</a>
</div>

<div class="card">
    <h5 class="card-header">Post info</h5>
    <div class="card-body">
      <h5 class="card-title"> title </h5>
      <p class="card-text">{{$posts->title}}</p>
      <h5 class="card-title"> Description </h5>
      <p class="card-text">{{$posts->description}}</p>
      <img src="{{Storage::disk('local')->url($posts->image)}}" alt="" srcset="" width="100px" height="100px">;    </div>
  </div>
    <br>
  <div class="card">
    <h5 class="card-header">Post creater info</h5>
    <div class="card-body">
      <h5 class="card-title">Name</h5>
      <select name="userId" class="form-control">
        @foreach($users as $user)
            <option value="{{$user->id}}"@if($user->id ==$posts->user_id) selected @else hidden @endif>{{$user->name}}</option>
        @endforeach
    </select>
      <h5 class="card-title">Email</h5>
      <select name="userId" class="form-control">
        @foreach($users as $user)
            <option value="{{$user->id}}"@if($user->id ==$posts->user_id) selected @else hidden @endif>{{$user->email}}</option>
        @endforeach
    </select>      
      <h5 class="card-title">Created At</h5>
      <p class="card-text">{{$posts->created_at->format('Y-m-d')}}</p>
      
    </div>
  </div>
  <form method="POST" action="{{route('comments.store',$id)}}">
    @csrf
    <div class="mb-3">
      <label for="exampleInputPassword1" class="form-label" style="font-weight:bold ;font-size:18px">Add your comment</label>
      <input type="text" class="form-control" id="exampleInputPassword1" name="comment">
    </div>
    <button type="submit" class="btn btn-primary">Submit</button>
  </form>
  @foreach($comments as $comment)
  <div class="card" @if($comment->post_id ==$posts->id) selected @else hidden @endif>
    <div class="card-header">
      comment
    </div>
   <div class="card-body" >

       <p class="card-text">{{$comment['comment_body']}}</p>
       <p class="card-text">created at {{$comment['created_at']->format('d F Y')}}</p>
       <form style="display: inline" action="{{route('comments.destroy', $comment['id'])}}" method="post">
        @csrf
        @method("delete")
    <button onclick="return confirm('Are you sure?')"  class="btn btn-danger">Delete</button>
    </form>
    </div>
  </div>
  @endforeach
@endsection