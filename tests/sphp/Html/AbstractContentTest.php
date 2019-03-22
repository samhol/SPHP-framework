<?php

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;

class AbstractContentTest extends TestCase {

  public function testPrintHtml() {
    $mock = $this->getMockForAbstractClass(AbstractContent::class);
    $mock->expects($this->any())
            ->method('getHtml')
            ->will($this->returnValue('value'));
    $this->expectOutputString('value');
    $mock->printHtml();
  }

  public function testException() {
    $exception = new \Exception;
    $mock = $this->getMockForAbstractClass(AbstractContent::class);
    $mock->expects($this->any())
            ->method('getHtml')
            ->willThrowException($exception);

    $this->expectOutputString("$exception");
    $mock->printHtml();
  }

}
