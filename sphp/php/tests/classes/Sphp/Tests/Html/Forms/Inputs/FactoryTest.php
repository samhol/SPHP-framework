<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs;

use Sphp\Html\Forms\Inputs\FormControls;
use Sphp\Exceptions\BadMethodCallException;
use Sphp\Exceptions\InvalidArgumentException;
use Sphp\Stdlib\Strings;

class FactoryTest extends AbstractFormControllerTest {

  public function testFactoring() {
    foreach (FormControls::getObjectMap() as $call => $objectType) {
      //echo "\nMap: $call => $objectType";
      $obj = FormControls::create($call);
      $this->assertInstanceOf($objectType, $obj);
      $this->assertInstanceOf($objectType, FormControls::$call());
      $str = FormControls::create($call);
      $this->assertTrue(str_starts_with("$str", '<' . $str->getTagName()));

      $this->doObjectTests($obj);
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
