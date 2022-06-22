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
use Sphp\Database\Predicates;
use Sphp\Database\Exceptions\InvalidArgumentException;

/**
 * The RuleTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RuleTest extends TestCase {

  public function isInData(): iterable {
    yield ['ints', [1, 2, 3], null];
    yield ['mixed', [1, '2', 3], null];
    yield ['mixed', new \ArrayObject([1, '2', 3]), null];
    yield ['empty_array', [], null];
    yield ['empty_iterator', new \ArrayObject(), null];
  }

  /**
   * @dataProvider isInData
   * 
   * @param  string $column
   * @param  iterable $group
   * @param  int|null $paramType
   * @return void
   */
  public function testIsIn(string $column, iterable $group, ?int $paramType): void {
    $count = count($group);
    if ($count === 0) {
      $this->expectException(InvalidArgumentException::class);
    } else {
      $groupStr = '(' . implode(', ', array_fill(0, $count, '?')) . ')';
    }
    $rule = new Predicates\IsIn($column, $group, $paramType);
    $this->assertCount(count($group), $params = $rule->getParams());
    $this->assertSame("$column IN $groupStr", "$rule");
  }

  /**
   * @dataProvider isInData
   * 
   * @param  string $column
   * @param  iterable $group
   * @param  int|null $paramType
   * @return void
   */
  public function testIsNotIn(string $column, iterable $group, ?int $paramType): void {
    $count = count($group);
    if ($count === 0) {
      $this->expectException(InvalidArgumentException::class);
    } else {
      $groupStr = '(' . implode(', ', array_fill(0, $count, '?')) . ')';
    }
    $rule = new Predicates\IsNotIn($column, $group, $paramType);
    $this->assertCount(count($group), $params = $rule->getParams());
    $this->assertSame("$column NOT IN $groupStr", "$rule");
  }
  
  public function testIsLikeAndNotLike(): void {
    $column = 'is_like';
    $rule1 = new Predicates\IsLike($column, 'a%');
    $this->assertSame("$column LIKE ?", "$rule1");
    $rule2 = new Predicates\NotLike($column,  'a%');
    $this->assertSame("$column NOT LIKE ?", "$rule2");
  }
}
