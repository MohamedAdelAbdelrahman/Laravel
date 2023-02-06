@extends('layouts.app')

@section('title') EDit @endsection

@section('content')
<style>
  body{
      background-color: rgb(8, 66, 113)
  }
    label,p{
        font-weight: bold;
    }
    </style>
  @if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
 <form method="Post" action="{{route('posts.update', $posts['id'])}}">
 @csrf
 @method('PUT')
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" value="{{$posts['title']}}" >
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <img src="{{Storage::disk('local')->url($posts->image)}}" alt="" srcset="" width="100px" height="100px">;    </div>

            <input type="file" name="image" class="form-control"  >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea name="description" class="form-control">{{$posts['description']}} </textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>
            <select name="userId" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}"@if($user->id ==$posts->user_id) selected @endif>{{$user->name}}</option>
                @endforeach
            </select>
        </div>

        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection