@extends('layouts.app')

@section('title') index @endsection

@section('content')

<style>
    body{
        background-color: rgb(8, 66, 113)
    }
</style>


<div class="text-end">
    <a href="{{route('posts.create')}}" class="mt-4 btn btn-primary">Create Post</a>
</div>
<div class="card mt-1">
    <div class="card-body">
        <table class="table mt-4">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Title</th>
                    <th scope="col">Posted By</th>
                    <th scope="col">Created At</th>
                    <th scope="col">Actions</th>
                </tr>
            </thead>
            <tbody>
        
                @foreach($posts as $post)
                {{-- @dd($post)--}}
                <tr>
                    {{-- <td>{{$post['id']}}</td>
                    <td>{{$post['title']}}</td>
                    <td>{{$post['posted_by']}}</td>
                    <td>{{$post['created_at']}}</td> --}}
                    
                    <td>{{$post->id}}</td>
                    <td>{{$post->title}}</td>
                    {{--//*1--}}
                    {{-- @if($post->user)
                    <td>{{$post->user->name}}</td>
                    @else <td> user not found </td>
                    @endif --}}
                    {{--//*2--}}   
                    {{-- <td>{{$post->user?->name}}</td> --}}
                    {{--//*3 error in display format of created_at(->format('Y-m-d')) --}}
                    <td>{{$post->user? $post->user->name:'Not Found'}}</td>
                    <td>{{$post->created_at}}</td>

                    <td>
                        <form action="{{ route('posts.destroy',$post->id)}}"
                            method="POST">
                        <a href="{{route('posts.show', $post['id'])}}" 
                        class="btn btn-info text-light">View</a>
                        <a href="{{route('posts.edit', $post['id'])}}" 
                        class="btn btn-primary">Edit</a>
                        @csrf
                        @method('DELETE')
                        <button type ="submit" class="btn btn-danger">Delete</button>
                </form>
                    </td>
                </tr>
                @endforeach
                
                
        
        
            </tbody>
        </table>
        {{ $posts->links('pagination::bootstrap-4') }}
    </div>
</div>

@endsection