<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\FormController;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\ValidableInput;
use Sphp\Html\Forms\Inputs\PatternValidableInput;
use Sphp\Html\Forms\Inputs\TextualInput;
use Sphp\Html\Forms\Inputs\Textarea;
use Sphp\Html\Forms\Inputs\BooleanInput;

/**
 * Description of AbstractFormControllerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
abstract class AbstractFormControllerTest extends TestCase {

  public function doObjectTests($obj): void {
    if ($obj instanceof FormController) {
      $this->doForFormController($obj);
    }
    if ($obj instanceof Input) {
      $this->doInput($obj);
    }
    if ($obj instanceof ValidableInput) {
      $this->doValidableInput($obj);
    }
    if ($obj instanceof PatternValidableInput) {
      $this->doPatternValidableInput($obj);
    }
    if ($obj instanceof TextualInput) {
      $this->doTextualInput($obj);
    }
    if ($obj instanceof Textarea) {
      $this->doTextArea($obj);
    }
    if ($obj instanceof BooleanInput) {
      $this->doBooleanInput($obj);
    }
  }

  protected function doForFormController(FormController $obj): void {
    $this->assertTrue($obj->isEnabled());
    $this->assertSame($obj, $obj->disable(true));
    $this->assertFalse($obj->isEnabled(), get_class($obj) . ' is still enabled');
    $this->assertSame($obj, $obj->disable(false));
    $this->assertTrue($obj->isEnabled());
  }

  protected function doInput(Input $obj): void {
    $this->assertFalse($obj->isNamed(), get_class($obj) . ' is named');
    $this->assertNull($obj->getName(), 'Input name for ' . get_class($obj) . ' is not null');
    $this->assertSame($obj, $obj->setName('foo'));
    $this->assertSame('foo', $obj->getName());
    $this->assertTrue($obj->isNamed(), get_class($obj) . ' should be named');
    $this->assertSame($obj, $obj->setName(null));
    $this->assertNull($obj->getName());
    $this->assertFalse($obj->isNamed());
  }

  protected function doValidableInput(ValidableInput $obj): void {
    //echo $obj;
    $this->assertFalse($obj->isRequired(), get_class($obj) . ' should not be required by default');
    $this->assertSame($obj, $obj->setRequired(true));
    $this->assertTrue($obj->isRequired(), get_class($obj) . ' should be required');
  }

  protected function doTextualInput(TextualInput $obj): void {
    if ($obj instanceof \Sphp\Html\Component) {
      $this->assertFalse($obj->attributeExists('placeholder'));
    }
    $this->assertSame($obj, $obj->setPlaceholder('placeholder'));
    if ($obj instanceof \Sphp\Html\Component) {
      $this->assertTrue($obj->attributeExists('placeholder'));
    }
    $this->assertFalse($obj->attributeExists('autocomplete'));
    $this->assertSame($obj, $obj->autocomplete(true));
    $this->assertEquals('on', $obj->getAttribute('autocomplete'));
    $this->assertSame($obj, $obj->autocomplete(false));
    $this->assertEquals('off', $obj->getAttribute('autocomplete'));
  }

  protected function doPatternValidableInput(PatternValidableInput $obj): void {
    $this->assertFalse($obj->hasPattern());
    $this->assertNull($obj->getPattern());
    $this->assertSame($obj, $obj->setPattern('/(foo)/'));
    $this->assertTrue($obj->hasPattern());
    $this->assertSame('/(foo)/', $obj->getPattern());
  }

  protected function doTextArea(Textarea $obj): void {
    $this->assertSame(null, $obj->getAttribute('wrap'));
    $this->assertSame($obj, $obj->wrap('soft'));
    $this->assertSame('soft', $obj->getAttribute('wrap'));
    $this->assertSame($obj, $obj->wrap('hard'));
    $this->assertSame('hard', $obj->getAttribute('wrap'));
  }

  protected function doBooleanInput(BooleanInput $obj) {
    $this->assertSame($obj, $obj->setChecked(true));
    $this->assertTrue($obj->attributeExists('checked'));
    $this->assertTrue($obj->isChecked());
    $this->assertSame($obj, $obj->setChecked(false));
    $this->assertFalse($obj->attributeExists('checked'));
    $this->assertFalse($obj->isChecked());
  }

}
