@extends('layouts.master')

@section('content')

    <h1>heloooo</h1>

    {{\Asus\Core\Auth::user()->name}}

    <a href="/auth/logout">Logout</a>
@endsection
