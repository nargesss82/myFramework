<?php namespace App\Http\Controller\Auth;



use App\Models\User;
use Asus\Haste\Controller;
use Asus\Haste\Request;
use Rakit\Validation\ErrorBag;
use Rakit\Validation\Validation;
use Rakit\Validation\Validator;

class RegisterController extends Controller
{

    public function registerView()
    {
        (session()->flash('old_inputs'));
        return $this->render('auth.register');
    }

    public function register()
    {

        $validation=$this->validate(request()->all(),[
            'name'=>'required|min:3|max:255',
            'email'=>'required|email|unique:users,email|max:255',
            'password'=>'required|min:8',
            'confirm_password'=>'required|same:password'
        ]);

        if($validation->fails()){
            return redirect('/auth/register');
        }

        $userData=$validation->getValidatedData();
        array_pop($userData);
        $password_hash=password_hash($userData['password'],PASSWORD_DEFAULT);
        array_pop($userData);
        $userData=array_merge($userData,['password'=>$password_hash]);

        (new User())->create($userData);


    }
}