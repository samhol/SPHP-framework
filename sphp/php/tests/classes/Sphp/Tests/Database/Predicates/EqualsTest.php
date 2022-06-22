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
use Sphp\Database\Predicates\Equals;
use PDO;

/**
 * The EqualsTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class EqualsTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['field', 'foo'];
    yield ['field', 2];
    yield ['field', 3.1415];
    yield ['field', null];
    yield ['field', true];
    yield ['field', false];
  }

  /**
   * @dataProvider constructordArgumentsData
   * 
   * @param string $column
   * @param string|int|float|bool|null $value
   * @param int $paramType
   * @return void
   */
  public function testConstructor(string $column, string|int|float|bool|null $value, int $paramType = PDO::PARAM_STR): void {
    $equals = new Equals($column, $value, $paramType);
    if ($value !== null) {
      $this->assertSame("$column = ?", "$equals");
      $this->assertCount(1, $params = $equals->getParams());
    } else {
      $this->assertSame("$column IS NULL", "$equals");
      $this->assertCount(0, $params = $equals->getParams());
    }
  }

}
