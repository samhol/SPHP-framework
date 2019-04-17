<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms;

use Sphp\Html\Forms\Inputs\TextualInput;
use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\FormControls;

class TextualInputTest extends AbstractInputTest {

  /**
   * @var TextualInput
   */
  protected $input;

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
  public function createInput(string $type = 'text'): Input {
    return new TextualInput($type);
  }

  public function testAutocomplete() {
    $this->assertFalse($this->input->attributeExists('autocomplete'));
    $this->assertSame($this->input, $this->input->autocomplete(true));
    $this->assertEquals('on', $this->input->getAttribute('autocomplete'));
    $this->assertSame($this->input, $this->input->autocomplete(false));
    $this->assertEquals('off', $this->input->getAttribute('autocomplete'));
  }

  public function testPattern() {
    $this->assertFalse($this->input->hasPattern());
    $this->assertNull($this->input->getPattern());
    $this->input->setPattern('/(foo)/');
    $this->assertTrue($this->input->hasPattern());
    $this->assertSame('/(foo)/', $this->input->getPattern());
  }

}
