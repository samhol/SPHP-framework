<?php

namespace Sphp\Html;

use PHPUnit\Framework\TestCase;

class ContentTraitTest extends TestCase {

  public function testPrintHtml() {
    $mock = $this->getMockForTrait(ContentTrait::class);
    $mock->expects($this->any())
            ->method('getHtml')
            ->will($this->returnValue('value'));
    $this->expectOutputString('value');
    $mock->printHtml();
  }

  public function testException() {
    $exception = new \Exception;
    $mock = $this->getMockForTrait(ContentTrait::class);
    $mock->expects($this->any())
            ->method('getHtml')
            ->willThrowException($exception);

    $this->expectOutputString("$exception");
    $mock->printHtml();
  }

}
