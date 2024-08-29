<?php

namespace Asus\Core;

class Session

{
    protected  const FLASH_KEY='_flash_message';
    public function __construct()
    {
        session_start();

        $_SESSION[self::FLASH_KEY]=array_map(function($flashMessage){
            $flashMessage['remove']=true;
            return $flashMessage;
        },$_SESSION[self::FLASH_KEY]??[]);
    }

    public function set(string $key,mixed $value):void
    {
        $_SESSION[$key]=$value;
    }
    public function get(string $key,mixed $default=null):mixed
    {
        return $_SESSION[$key]??$default;
    }
    public function remove(string $key)
    {
        unset($_SESSION[$key]);
    }

    public function flash(string $key,mixed $message=null)
    {
        if($message){
            $_SESSION[self::FLASH_KEY][$key]=[
                'value'=>$message,
                'remove'=>false
            ];
        }
     return $_SESSION[self::FLASH_KEY][$key]['value']??null;
    }


    public function __destruct()
    {
        $this->removeFlashMessages();
    }

    protected function removeFlashMessages()
    {
        $flashMessages=$_SESSION[self::FLASH_KEY]??[];
        $_SESSION[self::FLASH_KEY]=array_filter($flashMessages,fn($flashMessage)=>!$flashMessage['remove']);
    }

}