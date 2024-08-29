<?php

use Asus\Core\Application;

if(!function_exists('dd')) {
    function dd($value):void{
        var_dump($value);die;
    }
}

if(!function_exists('app')) {
    function app()
    {

        return Application::$app;
    }
}

if(!function_exists('request')) {
    function request($key=null):string|\Asus\Core\Request
    {

        if(is_null($key)) {
            return app()->request;
        }else{
            return app()->request->input($key);}
}
}
if(!function_exists('response')) {
    function response()
    {
        var_dump(app()->response);
        return app()->response;
    }
}
if(!function_exists('redirect')) {
    function redirect(string $url):\Asus\Core\Response
    {
        return response()->redirect($url);
    }
}
if(!function_exists('session')) {
    function session():?\Asus\Core\Session
    {
        return app()->session;
    }
}


