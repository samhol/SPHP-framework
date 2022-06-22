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
use Sphp\Database\Predicates\NotEquals;
use PDO;

/**
 * The EqualsTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class NotEqualsTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['field', 'foo', PDO::PARAM_STR];
    yield ['field', 2, null];
    yield ['field', 3.1415, null];
    yield ['field', null, null];
    yield ['field', true, null];
    yield ['field', false, null];
  }

  /**
   * @dataProvider constructordArgumentsData
   * 
   * @param string $column
   * @param string|int|float|bool|null $value
   * @param int|null $paramType
   * @return void
   */
  public function testConstructor(string $column, string|int|float|bool|null $value, ?int $paramType): void {
    $notEquals = new NotEquals($column, $value, $paramType);
    if ($value !== null) {
      $this->assertSame("$column <> ?", "$notEquals");
      $this->assertCount(1, $notEquals->getParams());
    } else {
      $this->assertSame("$column IS NOT NULL", "$notEquals");
      $this->assertCount(0, $notEquals->getParams());
    }
  }

}
