@extends('layouts.app')
@section('content')
<style>
    body {
  background: url('https://source.unsplash.com/twukN12EN7c/1920x1080') no-repeat center center fixed;
  -webkit-background-size: cover;
  -moz-background-size: cover;
  background-size: cover;
  -o-background-size: cover;
}
</style>

<!-- Page Content -->
<div class="container">
    <div class="card border-0 shadow my-5">
      <div class="card-body p-5">
        <h1 class="font-weight-light">放公司圖片</h1>
        <p class="lead">In this snippet, the background image is fixed to the body element. Content on the page will scroll, but the image will remain in a fixed position!</p>
        <p class="lead">Scroll down...</p>
        <div style="height: 700px"></div>
        <p class="lead mb-0">You've reached the end!</p>
      </div>
    </div>
  </div>
@endsection
