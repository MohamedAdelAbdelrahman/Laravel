@extends('layouts.app')

@section('title') create @endsection

@section('content') 
<style>
    body{
        background-color: rgb(8, 66, 113)
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
<div class="text-end">
    <a href="{{route('posts.index')}}" class="mt-4 btn btn-primary">Back</a>
</div>
 <form method="POST" action="/posts">
        @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label" >Description</label>
            <textarea
            name="description"
                class="form-control"
            ></textarea>
        </div>
        <div class="mb-3">
            <label class="form-check-label">Post Creator</label>

            <select name="post_creator" class="form-control">
            @foreach($users as $user)
             <option value="{{$user->id}}"> {{$user->name}}</option>
            @endforeach
            </select>
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection
