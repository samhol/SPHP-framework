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
  ConstraintsAggregate
};
use Sphp\DateTime\ImmutableDate;

/**
 * Class ConstraintsAggregate
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ConstraintsAggregateTest extends TestCase {

  public function testCase1(): void {
    $c = new ConstraintsAggregate();
    $c->isAnyOf()
            ->annual(1, 1)
            ->annual(1, 2)
            ->annual(1, 3);
    $c->isAnyOf()
            ->annual(1, 1)
            ->weekdays(1, 2);
    $c->isNot()->after('2001-1-1');
    $c->is()->after('1999-1-2');
    $this->assertTrue($c->isValid(ImmutableDate::from('2000-1-1')));
    //$this->assertTrue($c->isValid(ImmutableDate::from('last monday')));
    $this->assertFalse($c->isValid(ImmutableDate::from('2001-2-1')));
    $this->assertFalse($c->isValid(ImmutableDate::from('2000-2-2')));
    $this->assertFalse($c->isValid(ImmutableDate::from('1998-2-1')));
  }

  public function testIs(): void {
    $c = new ConstraintsAggregate();
    $c->is()
            ->date('2021-5 first sunday');

    $this->assertTrue($c->isValid(ImmutableDate::from('2021-5-2')));
    $this->assertFalse($c->isValid(ImmutableDate::from('2021-5-1')));
    $this->assertFalse($c->isValid(ImmutableDate::from('2021-5-3')));
  }

  public function testNot(): void {
    $c = new ConstraintsAggregate();
    $c->isNot()
            ->date('2021-1-3')
            ->date('2001-2 first monday')
            ->date('today');

    $c->isNot()->before('2021-1-1');
    $this->assertTrue($c->isValid(ImmutableDate::from('2021-1-2')));
    $this->assertFalse($c->isValid(ImmutableDate::from('today')));
  }

}
