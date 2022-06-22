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
use Sphp\Database\Predicates\Expression;
use PDO;

/**
 * The ExpressionTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ExpressionTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['field', 'foo', PDO::PARAM_STR];
    yield ['field', 2, PDO::PARAM_INT];
    yield ['field', 3.1415, null];
    yield ['field', null, null];
    yield ['field', true, null];
    yield ['field', false, null];
  }

  /**
   * @dataProvider constructordArgumentsData
   * 
   * @param  string $expession
   * @param  mixed $value
   * @param  int|null $paramType
   * @return void
   */
  public function testConstructor(string $expession, mixed $value, ?int $paramType): void {
    $expr = new Expression($expession, $value, $paramType);
    $this->assertSame($expession, "$expr");
    $this->assertCount(1, $params = $expr->getParams());
  }

}
