<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Calendars\Diaries;

use Sphp\Apps\Calendars\Diaries\Holidays\HolidayBuilder;

/**
 * Implements an event factory 
 * 
 * @method \Sphp\Apps\Calendars\Diaries\Holidays\HolidayBuilder holiday() Returns an instance of holiday log builder
 * @method \Sphp\Apps\Calendars\Diaries\\LogFactory log() Returns Returns an instance of mutable log builder
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class Logs {

  /**
   * 
   * @var LogFactory[]
   */
  private static $builders = [
      'holiday' => [HolidayBuilder::class],
      'log' => [LogFactory::class, BasicLog::class]
  ];

  public static function __callStatic(string $logType, array $params): LogFactory {
    if (!array_key_exists($logType, self::$builders)) {
      throw new \BadMethodCallException("$logType does not exist");
    }
    if (is_array(self::$builders[$logType])) {
      $type = self::$builders[$logType][0];
      if (isset(self::$builders[$logType][1])) {
        $logBuilder = new $type(self::$builders[$logType][1]);
      } else {
        $logBuilder = new $type();
      }
      self::$builders[$logType] = $logBuilder;
    } else {
      $logBuilder = self::$builders[$logType];
    }
    return $logBuilder;
  }

}
