@extends('layouts.app')

@section('title') Show @endsection

@section('content')
<style>
    h5{
        font-weight: bold;
    }
</style>
<div class="card my-5">
    <div class="card-header">
      Post info
    </div>
    <div class="card-body">
      <h5 class="card-title">Title: {{$post['title']}}</h5>
      <h5 class="card-title">Description: </h5>
      <p class="card-text">We will descripe the {{$post['title']}} language.</p>
    </div>
  </div>
<div class="card">
    <div class="card-header">
      Post Creator info
    </div>
    <div class="card-body">
      <h5 class="card-title ">Name: {{$post['posted_by']}}</h5>
      <h5 class="card-title ">Title: {{$post['title']}}</h5>
      <h5 class="card-title">Created at: {{$post['created_at']}}</h5>
      <p class="card-text">We will descripe the {{$post['title']}} language..</p>
    </div>
  </div>
  @endsection