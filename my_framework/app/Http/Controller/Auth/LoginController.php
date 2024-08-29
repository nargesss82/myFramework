<?php

namespace App\Http\Controller\Auth;

use App\Models\User;
use Asus\Core\Auth;
use Asus\Core\Controller;
use Rakit\Validation\ErrorBag;

class LoginController extends Controller
{

    public function loginView()
    {
        if(Auth::check()){
            return redirect('/user/panel');
        }
        return $this->render('auth.login');
    }
    public function login()
    {
        if(Auth::check()){
            return redirect('/user/panel');
        }
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

        Auth::login($user);

        redirect('/user/panel');
    }

    public function logout()
    {
        Auth::logout();
        return redirect('/auth/login');
    }
}