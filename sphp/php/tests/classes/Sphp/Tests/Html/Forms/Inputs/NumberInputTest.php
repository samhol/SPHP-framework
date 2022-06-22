<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Forms\Inputs;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Forms\Inputs\NumberInput;

/**
 * The NumberInputTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NumberInputTest extends TestCase {

  public function constructorData(): iterable {
    yield ['number', '1'];
    yield ['', '1.2'];
    yield ['1.2', 1];
    yield [' ', null];
    yield [null, 1.2];
  }

  /**
   * @dataProvider constructorData
   *  
   * @param  string|null $name
   * @param  string|int|float|null $value
   * @return void
   */
  public function testConstructor(?string $name, string|int|float|null $value): void {
    $input = new NumberInput($name, $value);
    $this->assertSame($name !== null, $input->isNamed());
    $this->assertSame($name, $input->getName());
    $this->assertEquals($value, $input->getSubmitValue());
    $this->assertNull($input->getMin());
    $this->assertNull($input->getMax());
  }

  public function rangeAndStepData(): iterable {
    yield [null, null, null];
    yield [1, 4, 1];
    yield [-4, 1, .5];
    yield [6, null, null];
    yield [null, -1.2, .2];
  }

  /**
   * @dataProvider rangeAndStepData
   * 
   * @param float|null $min
   * @param float|null $max
   * @return void
   */
  public function testRangeAndStep(?float $min, ?float $max, ?float $step): void {
    $input = new NumberInput('number-input', 2);
    $this->assertSame($input, $input->setStepLength($step));
    $this->assertSame($input, $input->setRange($min, $max));
    $this->assertSame($min, $input->getMin());
    $this->assertSame($max, $input->getMax());
    $this->assertSame($step, $input->getAttribute('step'));
  }

}
