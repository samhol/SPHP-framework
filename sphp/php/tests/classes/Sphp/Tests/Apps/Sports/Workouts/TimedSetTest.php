<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Sports\Workouts;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Sports\Workouts\TimedSet;
use Sphp\DateTime\Interval;
use Sphp\Apps\Sports\Workouts\Utils;

class TimedSetTest extends TestCase {

  public function durations(): array {
    $sets[] = ['P1DT1M'];
    $sets[] = ['PT1M'];
    $sets[] = ['P1DT1M'];
    $sets[] = ['P1DT1M'];
    return $sets;
  }

  /**
   * @dataProvider durations
   */
  public function testAddSet(string $durationString): void {
    $duration = new Interval($durationString);
    $set = new TimedSet($duration);
    $this->assertSame($duration, $set->getDuration());
    $this->assertEquals(['duration' => Utils::durationtoString($duration)], $set->toArray());
  }

}
