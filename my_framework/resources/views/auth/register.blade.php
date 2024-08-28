@extends('layouts.master')

@section('content')
    <form action="/auth/register" method="post" class="space-y-2 ">
        <div>
            <label for="name" >Name: </label>
            <input type="text" name="name" class="border-2 border-red-400" value="{{$old('name')}}">
            @if($errors->has('name'))
                <span>{{$errors->first('name')}}</span>
            @endif
        </div>
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
        <div>
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="confirm_password" class="border-2 border-red-400" value="{{$old('confirm_password')}}">
            @if($errors->has('confirm_password'))
                <span>{{$errors->first('confirm_password')}}</span>
            @endif
        </div>

        <button type="submit" class="bg-blue-400 p-2 text-white rounded">Register</button>
    </form>


@endsection

