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
use Sphp\Html\Forms\Inputs\HiddenInputs;
use Sphp\Html\Forms\Inputs\HiddenInput;

class HiddenInputsTest extends TestCase {

  public function arrayData(): array {
    $arr['foo'] = 'bar';
    return $arr;
  }

  public function createCollection(): \ArrayAccess {
    return new HiddenInputs();
  }

  public function testConstructor(): HiddenInputs {
    $instance = new HiddenInputs();
    $this->assertCount(0, $instance);
    $this->assertSame('', "$instance");
    return $instance;
  }

  /**
   * @depends testConstructor
   * @param  HiddenInputs $inputs
   * @return HiddenInputs
   */
  public function testInsert(HiddenInputs $inputs): HiddenInputs {
    $this->assertFalse($inputs->contains('var'));
    $input = $inputs->insertVariable('var', 1);
    $this->assertTrue($inputs->contains('var'));
    $this->assertCount(1, $inputs);
    $this->assertSame('var', $input->getName());
    $this->assertSame(1, $input->getSubmitValue());
    return $inputs;
  }

}
