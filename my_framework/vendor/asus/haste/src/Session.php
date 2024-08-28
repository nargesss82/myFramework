<?php

namespace Asus\Haste;

class Session
{
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

}