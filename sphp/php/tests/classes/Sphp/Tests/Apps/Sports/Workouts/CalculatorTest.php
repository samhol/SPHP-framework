<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Apps\Sports\Workouts;

use PHPUnit\Framework\TestCase;
use Sphp\Apps\Sports\Workouts\Calculator;
use Sphp\Apps\Sports\Exceptions\UnitMismatchExeption;

/**
 * The CalculatorTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CalculatorTest extends TestCase {

  public function paceData(): array {
    $sets[] = [1, 1];
    return $sets;
  }

  /**
   */
  public function testCalculatePace(): void {
    $s = 60 * 7;
    $m = 1000;
    $sm = $s / $m;
    $min_km = 1000 / 60 * $sm;
    $this->assertEquals($sm, Calculator::calculatePace($s, $m, 's/m'));
    $this->assertEquals(Calculator::calculatePace($s, $m), Calculator::calculatePace($s, $m, 's/m'));
    $this->assertEquals($min_km, Calculator::calculatePace($s, $m, 'min/km'));
    $this->expectException(UnitMismatchExeption::class);
    Calculator::calculatePace($s, $m, 'mph');
  }

  public function speedData(): array {
    $sets[] = [3, 4, 'm/s',];
    $sets[] = [3, 4, 'km/h'];
    $sets[] = [3, 4, 'mps'];
    return $sets;
  }

  /**
   */
  public function testCalculateSpeed(): void {
    $s = 4;
    $m = 3;
    $ms = $m / $s;
    $kmh = 3.6 * $ms;
    $mph = 0.0006213712 * 3600 * $ms;
    $this->assertEquals($ms, Calculator::calculateSpeed($s, $m, 'm/s'));
    $this->assertEquals(Calculator::calculateSpeed($s, $m), Calculator::calculateSpeed($s, $m, 'm/s'));
    $this->assertEquals($kmh, Calculator::calculateSpeed($s, $m, 'km/h'));
    $this->assertEquals($mph, Calculator::calculateSpeed($s, $m, 'mph'));
    $this->expectException(UnitMismatchExeption::class);
    Calculator::calculateSpeed($s, $m, 'min/km');
  }

}
