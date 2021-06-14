<?php

use App\Controllers\OperacionesController;
use PHPUnit\Framework\TestCase;
/**
 * [Description OperacionesControllerTest]
 */
class operacionesControllerTest extends  TestCase
{
    public function test_suma_de_operacion()
    {
        $obj = new OperacionesController();
        $expected = 11;
        $actual = $obj->suma(5,6);
        $this->assertEquals($expected, $actual);
    }
}
