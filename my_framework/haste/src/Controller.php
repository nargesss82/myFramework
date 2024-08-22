<?php

namespace Asus\Haste;

use Rakit\Validation\Validator;

class Controller
{

    protected function validate(array $data, array $rules, array $massages = [])
    {

        $validator = new Validator($massages);
        // make it
        $validation = $validator->make($data, $rules);

        // then validate
        $validation->validate();

        return $validation;
    }
    public function render(string $views,array $data=[])
    {

        $view=new Views();
        return $view->render($views,$data);


        // foreach($data as $key=>$value){
        //     $$key=$value;
        // }
        // include_once Application::$ROOT_DIR."/resources/views/$views.php";
    }
}
