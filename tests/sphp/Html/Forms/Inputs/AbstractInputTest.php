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
use Sphp\Html\Forms\Inputs\Input;

abstract class AbstractInputTest extends TestCase {

  /**
   * @var Input
   */
  protected $input;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->input = $this->createInput();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->input);
  }

  /**
   * @return Input
   */
  abstract public function createInput(string $type = 'text'): Input;

  public function testDisabling() {
    $this->assertTrue($this->input->isEnabled());
    $this->input->disable();
    $this->assertFalse($this->input->isEnabled());
  }

  public function testNaming() {
    $this->assertFalse($this->input->isNamed());
    $this->assertNull($this->input->getName());
    $this->input->setName('foo');
    $this->assertTrue($this->input->isNamed());
    $this->assertSame('foo', $this->input->getName());
    $this->input->setName(null);
    $this->assertFalse($this->input->isNamed());
    $this->assertNull($this->input->getName());
  }

  public function testInitialValue() {
    $this->assertNull($this->input->getSubmitValue());
    $this->input->setInitialValue('foo');
    $this->assertSame($this->input, $this->input->setInitialValue('foo'));
    $this->assertSame('foo', $this->input->getSubmitValue());
    $this->input->setInitialValue(null);
    $this->assertNull($this->input->getSubmitValue());
  }

}
