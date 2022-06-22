<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database\Parameters;

use PHPUnit\Framework\TestCase;
use Sphp\Database\Parameters\Parameter;
use PDO;

/**
 * The ParameterTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ParameterTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['', PDO::PARAM_STR];
    yield [2, PDO::PARAM_INT];
    yield [3.1415, null];
    yield [null, null];
    yield [true, null];
    yield [false, null];
  }

  /**
   * @dataProvider constructordArgumentsData
   *  
   * @param  mixed $value
   * @param  int|null $paramType
   * @return void
   */
  public function testConstructor(mixed $value, ?int $paramType): void {
    $par = new Parameter($value, $paramType);
    $this->assertSame($value, $par->getValue());
    if ($paramType !== null) {
      $this->assertSame($paramType, $par->getType());
    } else {
      $this->assertSame($par->resolveParameterType($value), $par->getType());
    }
  }

}
