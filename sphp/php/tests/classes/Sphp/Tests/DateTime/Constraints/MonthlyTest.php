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
use Sphp\DateTime\Constraints\Monthly;
use Sphp\DateTime\ImmutableDate;

/**
 * The MonthlyTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class MonthlyTest extends TestCase {

  public function testMultipleDays(): void {
    $rule = new Monthly(1, 17);
    $this->assertTrue($rule->isValid(ImmutableDate::from('2018-12-01')));
    $this->assertTrue($rule->isValid(ImmutableDate::from('2018-12-17')));
    $this->assertFalse($rule->isValid(ImmutableDate::from('2018-12-11')));
  }

}
