<?php
namespace App\Tests\Service\ApiMarvel;

use PHPUnit\Framework\TestCase;
use App\Service\ApiMarvel\SessionParam;

class SessionParamTest extends TestCase
{

    public function testGetSessionParams(){

        $SessionParam = new SessionParam($this->session);

        $test = ["limit" => 20];


        //$this->AssertEquals($test, $SessionParam->getSessionParams());

    }

}