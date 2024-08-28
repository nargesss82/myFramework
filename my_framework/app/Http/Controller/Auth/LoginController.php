<?php

namespace App\Http\Controller\Auth;

use App\Models\User;
use Asus\Haste\Controller;
use Rakit\Validation\ErrorBag;

class LoginController extends Controller
{

    public function loginView()
    {
        return $this->render('auth.login');
    }
    public function login()
    {
        $validation=$this->validate(request()->all(),[
            'email'=>'required|email|max:255|exists:users,email',
            'password'=>'required|min:8'
        ]);
        if($validation->fails()){
            redirect('/auth/login');
        }

        $validatedData=$validation->getValidatedData();
        $user=(new User())->find($validatedData['email'],'email');
        if(!password_verify($validatedData['password'],$user->password)){
            $errors=new ErrorBag();
            $errors->add('password','check_password','Wrong password');
            redirect('/auth/login')->withErrors($errors);
        }
        dd($user);
    }
}