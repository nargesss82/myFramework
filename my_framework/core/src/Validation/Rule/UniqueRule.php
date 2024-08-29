<?php

namespace Asus\Core\Validation\Rule;

use Asus\Core\Database\Model;
use Rakit\Validation\Rule;

class UniqueRule extends Rule
{

    protected $message = ":attribute :value has been used";

    protected $fillableParams = ['table', 'column'];

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters(['table', 'column']);

        // getting parameters
        $column = $this->parameter('column');
        $table = $this->parameter('table');

       $data= (new Model())->from($table)->where($column, $value)->getFirst();

       return !$data;


    }
}