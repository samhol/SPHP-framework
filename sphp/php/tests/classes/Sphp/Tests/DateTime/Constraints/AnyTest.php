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
  Before,
  After,
  AnyOfDates,
  AnyOf
};
use Sphp\DateTime\ImmutableDate;

/**
 * The NoneOfTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AnyTest extends TestCase {

  /**
   * @return void
   */
  public function testEmptyConstructor(): void {
    $a = ImmutableDate::from('2018-1-1');
    $b = ImmutableDate::from('2018-1-5');
    $rule = new AnyOf();
    $this->assertTrue($rule->isValid($a));
    $this->assertTrue($rule->isValid($b));
    $this->assertTrue($rule->isValid($a->jumpDays(-1)));
    $this->assertTrue($rule->isValid($a->jumpDays(1)));
    $this->assertTrue($rule->isValid($b->jumpDays(1)));
    $this->assertTrue($rule->isValid($b->jumpDays(-1)));
  }

  /**
   * @return void
   */
  public function testConstructorWithParameters(): void {
    $a = ImmutableDate::from('2018-1-1');
    $b = ImmutableDate::from('2018-1-5');
    $c1 = new AnyOfDates($a);
    $c2 = new AnyOfDates($b);
    $rule = new AnyOf($c1, $c2);
    $this->assertTrue($rule->isValid($a));
    $this->assertTrue($rule->isValid($b));
    $this->assertFalse($rule->isValid($a->jumpDays(-1)));
    $this->assertFalse($rule->isValid($a->jumpDays(1)));
    $this->assertFalse($rule->isValid($b->jumpDays(1)));
    $this->assertFalse($rule->isValid($b->jumpDays(-1)));
  }

  /**
   * @return void
   */
  public function testAddConstraint(): void {
    $a = ImmutableDate::from('2018-1-1');
    $b = ImmutableDate::from('2018-1-5');
    $c1 = new Before($a);
    $c2 = new After($b);
    $rule = new AnyOf();
    $this->assertSame($rule, $rule->addConstraint($c1));
    $this->assertSame($rule, $rule->addConstraint($c2));
    $this->assertTrue($rule->isValid($a->jumpDays(-1)));
    $this->assertTrue($rule->isValid($b->jumpDays(1)));
    $this->assertFalse($rule->isValid($a->jumpDays(1)));
    $this->assertFalse($rule->isValid($b->jumpDays(-1)));
  }

}
