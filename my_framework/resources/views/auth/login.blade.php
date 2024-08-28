@extends('layouts.master')

@section('content')
    <form action="/auth/login" method="post" class="space-y-2 ">
        <div>
            <label for="email">Email: </label>
            <input type="text" name="email" class="border-2 border-red-400" value="{{$old('email')}}">
            @if($errors->has('email'))
                <span>{{$errors->first('email')}}</span>
            @endif
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" class="border-2 border-red-400" value="{{$old('password')}}">
            @if($errors->has('password'))
                <span>{{$errors->first('password')}}</span>
            @endif
        </div>
        <button type="submit" class="bg-blue-400 p-2 text-white rounded">Login</button>
    </form>

@endsection
