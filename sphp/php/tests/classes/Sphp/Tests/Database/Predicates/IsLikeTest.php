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
use Sphp\Database\Predicates\IsLike;
use Sphp\Database\Parameters\SequentialParameterHandler;
use PDO;

/**
 * The IsLikeTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IsLikeTest extends TestCase {

  public function constructordArgumentsData(): iterable {
    yield ['a', '%foo'];
    yield ['a', '%foo%'];
  }

  /**
   * @dataProvider constructordArgumentsData
   * 
   * @param string $column
   * @param string $value 
   * @return void
   */
  public function testConstructor(string $column, string $value): void {
    $rule = new IsLike($column, $value);
    $parameterHandler = new SequentialParameterHandler();
    $parameterHandler->appendNewParams($value, PDO::PARAM_STR);
    $this->assertSame("$column LIKE ?", "$rule");
    $this->assertEquals($rule->getParams(), $parameterHandler);
  }

}
