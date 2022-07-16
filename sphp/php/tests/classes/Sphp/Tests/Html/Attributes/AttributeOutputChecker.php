<?php

/*
 * Click nbfs://nbhost/SystemFileSystem/Templates/Licenses/license-default.txt to change this license
 * Click nbfs://nbhost/SystemFileSystem/Templates/Scripting/PHPTrait.php to edit this template
 */

namespace Sphp\Tests\Html\Attributes;

use Sphp\Html\Attributes\Attribute;
use PHPUnit\Framework\Assert;

trait AttributeOutputChecker {

  protected function validateAttributeOutput(Attribute $attr): void {
    if ($attr->isVisible()) {
      Assert::assertSame("{$attr->getName()}=\"{$attr->getValue()}\"", "$attr");
    } else {
      Assert::assertSame('', "$attr");
    }
  }

}
