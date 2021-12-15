<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\Workouts;

use Sphp\Apps\Sports\Exceptions\UnitMismatchExeption;

/**
 * Class Calculator
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class Calculator {

  public const MIN_KM = 'min/km';
  public const S_KM = 's/km';
  public const S_M = 's/m';
  public const M_S = 'm/s';
  public const KM_H = 'km/h';

  private static $paceUnits = [
      's/m' => 1,
      'min/km' => 1000 / 60,
      'min/mile' => 1609.34 / 60
  ];

  /**
   * 
   * @param float $seconds
   * @param float $meters
   * @param string $unit
   * @return float
   * @throws UnitMismatchExeption
   */
  public static function calculatePace(float $seconds, float $meters, string $unit = 's/m'): float {
    if (!array_key_exists($unit, self::$paceUnits)) {
      throw new UnitMismatchExeption('Invalid pace unit (' . $unit . ')');
    }
    return $seconds / $meters * self::$paceUnits[$unit];
  }

  private static $speedUnits = [
      'm/s' => 1,
      'km/h' => 3.6,
      'mph' => 0.0006213712 * 3600
  ];

  /**
   * 
   * @param  float $seconds
   * @param  float $meters
   * @param  string $unit
   * @return float
   * @throws UnitMismatchExeption
   */
  public static function calculateSpeed(float $seconds, float $meters, string $unit = 'm/s'): float {
    if (!array_key_exists($unit, self::$speedUnits)) {
      throw new UnitMismatchExeption('Invalid speed unit (' . $unit . ')');
    }
    return $meters / $seconds * self::$speedUnits[$unit];
  }

}
