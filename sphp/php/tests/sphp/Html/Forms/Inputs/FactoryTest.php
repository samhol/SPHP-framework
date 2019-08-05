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
use Sphp\Html\Forms\FormController;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\ValidableInput;

class FactoryTest extends TestCase {

  public function testFactoring() {
    foreach (FormControls::getObjectMap() as $call => $objectType) {
      //echo "\nMap: $call => $objectType";
      $obj = FormControls::create($call);
      $this->assertInstanceOf($objectType, $obj);
      $this->assertInstanceOf($objectType, FormControls::$call());
      $str = FormControls::create($call);
      $this->assertTrue(Strings::startsWith("$str", '<' . $str->getTagName()));
      if ($obj instanceof FormController) {
        $this->doForFormController($obj);
      }
      if ($obj instanceof Input) {
        $this->doInput($obj);
      }
      if ($obj instanceof ValidableInput) {
        $this->doValidableInput($obj);
      }
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

  protected function doForFormController(FormController $obj) {
    $this->assertTrue($obj->isEnabled());
    $this->assertSame($obj, $obj->disable(true));
    $this->assertFalse($obj->isEnabled(), get_class($obj) . ' is still enabled');
    $this->assertSame($obj, $obj->disable(false));
    $this->assertTrue($obj->isEnabled());
  }

  protected function doInput(Input $obj) {
    $this->assertFalse($obj->isNamed(), get_class($obj) . ' is named');
    $this->assertNull($obj->getName(), 'Input name for ' . get_class($obj) . ' is not null');
    $this->assertSame($obj, $obj->setName('foo'));
    $this->assertSame('foo', $obj->getName());
    $this->assertTrue($obj->isNamed(), get_class($obj) . ' should be named');
    $this->assertSame($obj, $obj->setName(null));
    $this->assertNull($obj->getName());
    $this->assertFalse($obj->isNamed());
  }

  protected function doValidableInput(ValidableInput $obj) {
    $this->assertFalse($obj->isRequired());
    $this->assertSame($obj, $obj->setRequired(true));
    $this->assertTrue($obj->isRequired(), get_class($obj) . ' should be required');
  }

}
