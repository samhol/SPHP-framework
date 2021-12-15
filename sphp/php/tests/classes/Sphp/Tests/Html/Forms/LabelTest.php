<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Label;
use Sphp\Html\Forms\Inputs\TextInput;

/**
 * The LabelTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LabelTest extends TestCase {

  
  public function constructorData(): iterable {
    $opt = new Option('baz', new TextInput());
    yield ['foo', ['foo' => 'bar']];
    yield [null, ['foo' => 'bar']];
    yield [null, ['foo' => 'bar', $opt]];
  }
  
  /**
   * @return Label
   */
  public function testConstructorWithParams(): Label {
    $input = new TextInput();
    $label = new Label($input, $input);
    $this->assertSame($input->identify(), $label->getFor());
    $this->assertEmpty($label->getForms());
    return $label;
  }
  /**
   * @return Label
   */
  public function testEmptyConstructor(): Label {
    $label = new Label();
    $this->assertNull($label->getFor());
    $this->assertEmpty($label->getForms());
    return $label;
  }

  /**
   * @depends testEmptyConstructor
   * 
   * @param Label $label
   */
  public function testFor(Label $label) {
    $input = new TextInput;
    $label->setAttribute('for', 1);
    $this->assertSame('1', $label->getFor());
    $this->assertSame($label, $label->setFor($input));
    $this->assertSame($input->identify(), $label->getFor());
  }

  /**
   * @depends testEmptyConstructor
   * 
   * @param Label $label
   */
  public function testForms(Label $label) {
    $ids = ['foo', 'bar'];
    $input = new TextInput;
    $label->setAttribute('form', 1);
    $this->assertSame(['1'], $label->getForms());
    $this->assertSame($label, $label->setForms(... $ids));
    $this->assertSame($ids, $label->getForms());
    $this->assertSame(implode(' ', $ids), $label->getAttribute('form'));
  }

}
