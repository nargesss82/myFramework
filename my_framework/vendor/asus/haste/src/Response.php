<?php

namespace Asus\Haste;

class Response
{

    public function redirect($url):self
    {
     header("Location: $url");
     return $this;
    }
}