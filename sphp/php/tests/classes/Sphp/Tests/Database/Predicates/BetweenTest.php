<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2022 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Database\Predicates;

use PHPUnit\Framework\TestCase;
use Sphp\Database\Predicates\Between;
use Sphp\Database\Parameters\SequentialParameterHandler;
use PDO;

/**
 * The BetweenTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BetweenTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['col', 'a', 'b', PDO::PARAM_STR];
    yield ['col', 1, 3, PDO::PARAM_INT];
    yield ['col', 'a', 'b', null];
    yield ['col', 1, 3, null];
  }

  /**
   * @dataProvider constructordArgumentsData
   * 
   * @param  string $column
   * @param  string|int|float $min
   * @param  string|int|float $max
   * @param  int|null $paramType
   * @return void
   */
  public function testConstructor(string $column, string|int|float $min, string|int|float $max, ?int $paramType): void {
    $rule = new Between($column, $min, $max, $paramType);
    $parameterHandler = new SequentialParameterHandler();
    $parameterHandler->appendNewParams([$min, $max], $paramType);
    $this->assertSame("$column BETWEEN ? AND ?", "$rule");
    $this->assertCount(2, $params = $rule->getParams());
    $this->assertEquals($rule->getParams(), $parameterHandler);
  }

}
