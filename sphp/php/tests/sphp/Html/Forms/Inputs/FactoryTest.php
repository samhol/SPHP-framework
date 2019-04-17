<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\FormControls;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;

class FactoryTest extends TestCase {

  public function testFactoring() {
    foreach (FormControls::getObjectMap() as $call => $objectType) {
      //echo "\nMap: $call => $objectType";
      $this->assertInstanceOf($objectType, FormControls::create($call));
      $this->assertInstanceOf($objectType, FormControls::$call());
      $str = FormControls::create($call);
      $this->assertTrue(Strings::startsWith("$str", '<' . $str->getTagName()));
    }
  }

  public function testInvalidCreateMethodCall() {
    $this->expectException(InvalidArgumentException::class);
    FormControls::create('foo');
  }

  public function testInvalidMagicCall() {
    $this->expectException(BadMethodCallException::class);
    FormControls::foo('foo');
  }

}
