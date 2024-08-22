@extends('layouts.master')
@section('title','create article')
@section('content')
<h2>{{$title}}</h2>
<h3>{{$title2 }}</h3>
@if ($auth){
<span>you are logged in</span>
}
@else{
<span>you are not logged in</span>
}
@endif
<form action="/article/createeee" method="post">
    <input type="text" name="title" placeholder="enter title">
    <button type="submit">create</button>
</form>
@endsection