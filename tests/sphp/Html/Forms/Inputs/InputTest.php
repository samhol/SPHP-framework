<?php

namespace Sphp\Tests\Html\Forms;

use Sphp\Html\Forms\Inputs\InputInterface;
use Sphp\Html\Forms\Inputs\Factory;

class InputTests extends \PHPUnit\Framework\TestCase {

  /**
   * @var InputInterface
   */
  protected $list;

  /**
   * @return InputInterface
   */
  public function createInput(): InputInterface {
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
   * @param InputInterface $input
   */
  public function testDisabling(InputInterface $input) {
    $this->assertTrue($input->isEnabled());
    $input->disable();
    $this->assertFalse($input->isEnabled());
  }

  /**
   * @dataProvider instances
   * 
   * @param InputInterface $input
   */
  public function testNaming(InputInterface $input) {
    $this->assertFalse($input->isNamed());
    $input->setName('foo');
    $this->assertTrue($input->isNamed());
    $this->assertSame('foo', $input->getName());
  }
}
