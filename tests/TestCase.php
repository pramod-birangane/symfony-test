<?php
namespace App\Tests;

use PHPUnit\Framework\TestCase;
use App\Controller\AuthController;
use Symfony\Component\HttpFoundation\Request;

class ProgrammerControllerTest extends TestCase
{
  public function testSimpleCase()
  {
    $objRequest = new Request(["_username" => "pramod", "_password" => "pramod123"]);
    $objRequest->setMethod("GET");
    $objAuth = new AuthController();
    $this->assertEquals('{"_username":"pramod","_password":"pramod123","method":"GET"}', $objAuth->testFunction($objRequest));
  }

  /*public function testApi(){
    $objRequest = new Request();
    $objRequest->setMethod("GET");

    $objAuth = new AuthController();
    $this->assertEquals('["team 1 1","team 1 2"]',$objAuth->api(1, $objRequest));
  }*/
}
