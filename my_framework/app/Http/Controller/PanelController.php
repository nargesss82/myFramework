<?php

namespace App\Http\Controller;

use Asus\Core\Auth;
use Asus\Core\Controller;

class PanelController extends Controller
{
    public function index()
    {
        if(!Auth::check()){
            return redirect('/auth/login');
        }
        return $this->render('panel.index');
    }

}