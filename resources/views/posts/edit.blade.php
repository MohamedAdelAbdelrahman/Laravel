@extends('layouts.app')

@section('title') edit @endsection

@section('content')
<style>
  body{
      background-color: rgb(8, 66, 113)
  }
    label,p{
        font-weight: bold;
    }
</style>
<form action="/posts/{{$post['id']}}" method="POST">
  @csrf
  @method('PUT')
  <div class="mb-3">
    <label for="title" class="form-label">Title</label>
    <input type="text" class="form-control" name="title" value="{{$post['title']}}" id="title">
  </div>
  <div class="form-floating mb-3">
    <p class="form-label">Description</p>
    <textarea class="form-control" id="desc" name="description" style="height: 100px">
      {{ $post->description}}</textarea>
  </div>
  <div class="mb-3">
    <label class="form-check-label">Post Creator</label>

    <select name="posted_at" class="form-control">
    @foreach($users as $user)
     <option value="{{$user->id}}" @if ($user-> id == $post->user_id) selected @endif> {{$user->name}}</option>
    @endforeach
    </select>
</div>
  
  {{-- <div class="mb-3">
    <label for="title" class="form-label">Post Creator</label> --}}
    {{-- @if(!$post->user->id)
    <input type="text" name="posted_at" value="user not found" class="form-control" id="creator">
    @else --}}
    {{-- <input type="text" name="posted_at" value="{{$post->user->id}}" class="form-control" id="creator"> --}}
    {{-- @endif --}}
  {{-- </div> --}}
  <button type="submit" class="btn btn-primary">Update</button>
</form>
  @endsection

  {{-- <select name="author_id" class="form-control" id="post-author">      @foreach ($users as $user)      <option value="{{$user->id}}" {{$post->user_id === $user->id ? 'selected' : ''}}>        {{$user->name}}      </option>      @endforeach    </select> --}}