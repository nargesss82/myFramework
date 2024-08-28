<?php

namespace Asus\Haste;

use Asus\Haste\Validation\Rule\ExistsRule;
use Asus\Haste\Validation\Rule\UniqueRule;
use Rakit\Validation\Validator;

class Controller
{

    protected function validate(array $data, array $rules, array $massages = [])
    {

        $validator = new Validator($massages);
        $validator = new Validator;

        $validator->addValidator('unique', new UniqueRule());
        $validator->addValidator('exists', new ExistsRule());
        // make it
        $validation = $validator->make($data, $rules);

        // then validate
        $validation->validate();

        if($validation->fails()){
            response()->withErrors($validation->errors())->withInputs();
        }

        return $validation;
    }
    public function render(string $views,array $data=[])
    {

        $view=app()->views;
        return $view->render($views,$data);


        // foreach($data as $key=>$value){
        //     $$key=$value;
        // }
        // include_once Application::$ROOT_DIR."/resources/views/$views.php";
    }
}
