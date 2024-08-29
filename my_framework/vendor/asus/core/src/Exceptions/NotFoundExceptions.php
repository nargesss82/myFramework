<?php

namespace Asus\Core\Exceptions;

class NotFoundExceptions extends \Exception
{

    protected $code=404;
    protected $message="Route Not Found";
}