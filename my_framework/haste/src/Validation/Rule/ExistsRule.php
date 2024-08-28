<?php

namespace Asus\Haste\Validation\Rule;

use Asus\Haste\Database\Model;
use Rakit\Validation\Rule;

class ExistsRule extends Rule
{

    protected $message = ":attribute :value is not exists";

    protected $fillableParams = ['table', 'column'];

    public function check($value): bool
    {
        // make sure required parameters exists
        $this->requireParameters(['table', 'column']);

        // getting parameters
        $column = $this->parameter('column');
        $table = $this->parameter('table');

        $data= (new Model())->from($table)->where($column, $value)->getFirst();

        return (bool)$data;


    }
}