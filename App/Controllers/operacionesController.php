<?php

namespace App\Controllers;

use Libs\controller;

class OperacionesController extends controller
{

    public function suma(int $n1,int $n2):int
    {
        return $n1 + $n2;
    }
}
