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
use Sphp\Database\Predicates\PredicateSet;
use Sphp\Database\Predicates\Equals;
use Sphp\Database\Exceptions\BadMethodCallException;

/**
 * The RuleSetTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RuleSetTest extends TestCase {

  public function testConstructor(): PredicateSet {
    $ruleSet = new PredicateSet();
    $this->assertFalse($ruleSet->notEmpty());
    $params = $ruleSet->getParams();
    $this->assertCount(0, $params);
    $this->assertCount(0, $ruleSet);
    $this->assertSame('', "$ruleSet");
    return $ruleSet;
  }

  public function testAddRules(): PredicateSet {
    $ruleSet = new PredicateSet();
    $notEquals = new Predicates\NotEquals('string', 'str');
    $ruleSet->notEquals('string', 'str');
    $this->assertEquals("$notEquals", "$ruleSet");
    $ruleSet->andEquals('int', 1, \PDO::PARAM_INT);
    $params = $ruleSet->getParams();
    $this->assertCount(2, $params);
    $andEquals = new Equals('int', 1, \PDO::PARAM_INT);
    $this->assertEquals("$notEquals AND $andEquals", "$ruleSet");
    return $ruleSet;
  }

  /**
   * @depends testAddRules
   * 
   * @param  PredicateSet $ruleSet
   * @return PredicateSet
   */
  public function testAddRuleSet(PredicateSet $ruleSet): PredicateSet {
    $ruleSet1 = new PredicateSet();
    $ruleSet1->between('num', -1, 1);
    $str = "$ruleSet";
    $ruleSet->fulfills($ruleSet1, 'OR');
    $this->assertEquals("$str OR ($ruleSet1)", "$ruleSet");
    return $ruleSet;
  }

  public function invalidMethodData(): iterable {
    yield ['andFoo', ['a', 1]];
    yield ['1', ['a', 1]];
    yield ['andEquals', ['a', 1, 'string']];
  }

  /**
   * @dataProvider invalidMethodData
   * 
   * @param  string $name
   * @param  array $arguments
   * @return void
   */
  public function testInvalidMagicCalls(string $name, array $arguments): void {
    $ruleSet = new PredicateSet();
    $this->expectException(BadMethodCallException::class);
    $ruleSet->$name(...$arguments);
  }

}
