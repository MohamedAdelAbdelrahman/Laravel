@extends('layouts.app')

@section('title') create @endsection


@if ($errors->any())
        <div class="alert alert-danger">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

@section('content')
<style>
    body{
        background-color: rgb(8, 66, 113);
        font-weight: bold;
    }
  </style>
 <form method="POST" action="/posts" enctype="multipart/form-data">
 @csrf
        <div class="mb-3">
            <label class="form-label">Title</label>
            <input type="text" name="title" class="form-control" >
        </div>
        <div class="mb-3">
            <label  class="form-label">Description</label>
            <textarea
            name="description"
                class="form-control"
            ></textarea>
        </div>
        <div class="mb-3">
            <label  class="form-check-label">Post Creator</label>

            <select name="userId" class="form-control">
                @foreach($users as $user)
                    <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label class="form-label">Image</label>
            <input type="file" name="image" class="form-control" >
        </div>
        <button type="submit" class="btn btn-success">Submit</button>
    </form>
@endsection