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
  VaryingAnnual,
};
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Exceptions\{
  InvalidArgumentException
};

/**
 * The VaryingAnnualTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class VaryingAnnualTest extends TestCase {

  public function testVaryingAnnual(): void {
    $varyingAnnual = new VaryingAnnual('%d-11-30 next Saturday');
    $this->assertTrue($varyingAnnual->isValid(ImmutableDate::from('2018-12-01')));
    $this->assertFalse($varyingAnnual->isValid(ImmutableDate::from('2018-12-02')));
    // $this->assertFalse($varyingAnnual->isValid('foo'));
  }

  public function testAlwaysFalse(): void {
    $this->expectException(InvalidArgumentException::class);
    new VaryingAnnual('no specifiers');
  }

}
