<?php

namespace Sphp\Tests\Html\Forms;

use Sphp\Html\Forms\Inputs\Input;
use Sphp\Html\Forms\Inputs\Factory;

class InputTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var Input
   */
  protected $list;

  /**
   * @return Input
   */
  public function createInput(): Input {
    $this->list = new Ul();
  }

  /**
   * @return array
   */
  public function instances(): array {
    return [
        [Factory::text()],
        [Factory::number()],
        [Factory::email()],
        [Factory::select()],
        [Factory::hidden()],
        [Factory::checkbox()],
        [Factory::radio()],
    ];
  }

  /**
   * @dataProvider instances
   * 
   * @param Input $input
   */
  public function testDisabling(Input $input) {
    $this->assertTrue($input->isEnabled());
    $input->disable();
    $this->assertFalse($input->isEnabled());
  }

  /**
   * @dataProvider instances
   * 
   * @param Input $input
   */
  public function testNaming(Input $input) {
    $this->assertFalse($input->isNamed());
    $input->setName('foo');
    $this->assertTrue($input->isNamed());
    $this->assertSame('foo', $input->getName());
  }

}
