<?php

namespace Asus\Haste;

use Rakit\Validation\ErrorBag;

class Response
{

    public function redirect($url):self
    {
     header("Location: $url");
     return $this;
    }

    public function withErrors(ErrorBag $errors):self
    {
        session()->flash('errors',$errors);
        return $this;
    }

    public function withInputs(array $inputs=null):self
    {
        session()->flash('old_inputs',!is_null($inputs)?$inputs:request()->all());

        return $this;
    }
}