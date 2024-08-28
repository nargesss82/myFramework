@extends('layouts.master')

@section('content')
    <form action="/auth/register" method="post" class="space-y-2 ">
        <div>
            <label for="name" >Name: </label>
            <input type="text" name="name" class="border-2 border-red-400">
        </div>
        <div>
            <label for="email">Email: </label>
            <input type="email" name="email" class="border-2 border-red-400">
        </div>
        <div>
            <label for="password">Password: </label>
            <input type="password" name="password" class="border-2 border-red-400">
        </div>
        <div>
            <label for="confirm_password">Confirm Password: </label>
            <input type="password" name="confirm_password" class="border-2 border-red-400">
        </div>

        <button type="submit" class="bg-blue-400 p-2 text-white rounded">Register</button>
    </form>


@endsection

