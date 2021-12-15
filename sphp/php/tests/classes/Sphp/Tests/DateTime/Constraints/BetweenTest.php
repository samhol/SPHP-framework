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
  Between,
};
use Sphp\DateTime\{
  Date,
  ImmutableDate,
  ImmutableDateTime
};

/**
 * Class OneOfTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class BetweenTest extends TestCase {

  public function betweeData(): array {
    $out = [];
    $out [] = [ImmutableDate::from('2018-1-1'), ImmutableDate::from('2018-1-5')];
    $out [] = [ImmutableDate::from('2018-1-1'), ImmutableDate::from('2018-1-1')];
    $out [] = [ImmutableDate::from('2000-2-29'), ImmutableDate::from('2000-2-29')];
    return $out;
  }

  /**
   * @dataProvider betweeData
   * 
   * @param  Date $start
   * @param  Date $end
   * @return void
   */
  public function testBetween(Date $start, Date $end): void {
    $rule = new Between($start, $end);
    $this->assertTrue($rule->isValid($start));
    $this->assertTrue($rule->isValid($end));
    $this->assertFalse($rule->isValid($start->jumpDays(-1)));
    $this->assertFalse($rule->isValid($end->jumpDays(1)));
    $clone = clone $rule;
    $this->assertNotSame($rule, $clone);
    $this->assertEquals($rule, $clone);
  }

}
