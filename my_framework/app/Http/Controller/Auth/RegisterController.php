<?php namespace App\Http\Controller\Auth;



use Asus\Haste\Controller;
use Asus\Haste\Request;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

class RegisterController extends Controller
{

    public function registerView()
    {
        return $this->render('auth.register');
    }

    public function register()
    {

        $validation=$this->validate(request()->all(),[
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|max:255',
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password'
        ]);

        if($validation->fails()){
            return redirect('/auth/register');
        }
        dd($validation->errors());

    }
}