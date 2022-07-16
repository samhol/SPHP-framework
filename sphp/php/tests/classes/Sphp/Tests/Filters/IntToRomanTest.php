<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Filters;

namespace Sphp\Tests\Filters;

use PHPUnit\Framework\TestCase;
use Sphp\Filters\IntegerToRoman;

/**
 * Class IntToRomanTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IntToRomanTest extends TestCase {

  public function getFilter(): IntegerToRoman {
    return new IntegerToRoman();
  }

  public function validFilterPairsProvider(): iterable {
    yield [1, 'I'];
    yield [5, 'V'];
  }

  /**
   * @dataProvider validFilterPairsProvider
   * 
   * @param  mixed $var
   * @param  mixed $expected
   * @return void
   */ 
  public function testValidFilter(mixed $var, mixed $expected): void {
    $filter = $this->getFilter(); 
    $this->assertSame($expected, $filter->filter($var));
    $this->assertSame($expected, $filter($var));
  }

  public function invalidFilterPairsProvider(): iterable {
    yield [1, 'I'];
    yield [5, 'V'];
  }

  /**
   * @dataProvider validFilterPairsProvider
   * 
   * @param  mixed $var
   * @param  mixed $expected
   * @return void
   */ 
  public function testInvalidFilter(mixed $var, mixed $expected): void {
    $filter = $this->getFilter();
    $filter->filter($var);
    $this->assertSame($expected, $filter->filter($var));
    $this->assertSame($expected, $filter($var));
  }
}
