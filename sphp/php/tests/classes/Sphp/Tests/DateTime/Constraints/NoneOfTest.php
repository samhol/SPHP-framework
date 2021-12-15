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
  NoneOf
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
class NoneOfTest extends TestCase {

  /**
   * @return void
   */
  public function testBetween(): void {
    $start = ImmutableDate::from('2018-1-1');
    $end = ImmutableDate::from('2018-1-5');
    $between = new Between($start, $end);
    $rule = new NoneOf($between);
    $this->assertTrue($rule->isValid($start->jumpDays(-1)));
    $this->assertTrue($rule->isValid($end->jumpDays(1)));
    $this->assertFalse($rule->isValid($start));
    $this->assertFalse($rule->isValid($end));
  }

}
