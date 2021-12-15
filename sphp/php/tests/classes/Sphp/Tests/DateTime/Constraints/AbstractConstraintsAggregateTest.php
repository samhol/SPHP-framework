<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\DateTime\Constraints;

use PHPUnit\Framework\TestCase;
use Sphp\DateTime\Constraints\{
  Annual,
  AbstractConstraintsAggregate,
  DateConstraint
};

/**
 * Class AbstractConstraintsAggregateTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractConstraintsAggregateTest extends TestCase {

  public function betweeData(): array {
    $out = [];
    $out [] = ['2018-1-1', '2018-1-5'];
    $out [] = ['2018-1-1', '2018-1-1'];
    $out [] = ['2000-2-29', '2000-2-29'];
    return $out;
  }

  public function createInstance(DateConstraint ... $c): AbstractConstraintsAggregate {
    return $this->getMockForAbstractClass(AbstractConstraintsAggregate::class, $c);
  }

  /**
   * @return void
   */
  public function testEmptyConstructor(): void {
    $rule = $this->createInstance();
    $this->assertCount(0, $rule);
    $this->assertEmpty($rule);
  }

  /**
   * @return void
   */
  public function testConstructorWithParams(): void {
    $c1 = new Annual(5, 21);
    $c2 = new Annual(5, 22);
    $rule = $this->createInstance($c1, $c2);
    $this->assertCount(2, $rule);
    $this->assertNotEmpty($rule);
    $this->assertContains($c1, $rule);
    $this->assertContains($c2, $rule);
  }

  /**
   * @return void
   */
  public function testRuleAdding(): void {
    $c1 = new Annual(5, 21);
    $c2 = new Annual(5, 22);
    $rule = $this->createInstance();
    $this->assertSame($rule, $rule->addConstraint($c1));
    $this->assertContains($c1, $rule);
    $this->assertNotEmpty($rule);
    $this->assertCount(1, $rule);
    $this->assertSame($rule, $rule->addConstraint($c2));
    $this->assertContains($c2, $rule);
    $this->assertCount(2, $rule);
  }

  /**
   * @return void
   */
  public function testFactoring(): void {
    $c1 = new Annual(5, 21);
    $rules1 = $this->createInstance();
    $rules2 = $this->createInstance();
    $this->assertSame($rules1, $rules1->addConstraint($c1));
    $this->assertContains($c1, $rules1);
    $this->assertSame($rules2, $rules2->annual(5, 21));
    $this->assertEquals($rules2, $rules1);
  }

  /**
   * @return void
   */
  public function testCloning(): void {
    $c1 = new Annual(5, 21);
    $rules1 = $this->createInstance($c1);
    $rules2 = clone $rules1;
    $this->assertNotSame($rules2, $rules1);
    $arr2 = iterator_to_array($rules2);
    $this->assertContains($c1, $rules1);
    $this->assertNotSame($c1, $arr2[0]);
    $this->assertEquals($c1, $arr2[0]);
  }

}
