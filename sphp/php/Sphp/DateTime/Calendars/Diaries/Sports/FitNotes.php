<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Diaries\MutableDiary;

/**
 * Implements a factory for Diary creation from FitNotes application data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FitNotes {

  const DATE = 0;
  const EXERCISE = 1;
  const CATEGORY = 2;
  const WEIGHT = 3;
  const REPS = 4;
  const DISTANCE = 5;
  const DISTANCE_UNIT = 6;
  const TIME = 7;
  const COMMENT = 8;

  /**
   * Parses exercises from FitNotes csv file 
   * 
   * @param  string $path path to FitNotes csv file
   * @return MutableDiary
   */
  public static function fromCsv(string $path): MutableDiary {
    $rawData = Parser::csv()->readFromFile($path); //print_r($rawData);
    array_shift($rawData);
    $coll = new MutableDiary();
    $log = $date = null;
    $rawDate = '';

    //var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
    foreach ($rawData as $row) {
      if (!isset($date) || $rawDate !== $row[self::DATE]) {
        $rawDate = $row[self::DATE];
        $date = new Date($rawDate);
        $log = new Workouts($date);
        $coll->insertLog($log);
      }
      $name = $row[self::EXERCISE];
      $category = $row[self::CATEGORY];
      if ($row[self::WEIGHT] > 0 && $row[self::REPS] > 0) {
        $ex = $log->weightLiftingExercise($name, $category);
        $ex->addSet((float) $row[self::WEIGHT], (int) $row[self::REPS]);
      } else if (!empty($row[self::TIME])) {
        if ($row[self::DISTANCE] > 0) {
          $ex = $log->distanceAndTimeExercise($name, $category);
          if ($row[self::DISTANCE_UNIT] !== '') {
            $unit = $row[self::DISTANCE_UNIT];
          } else {
            $unit = 'km';
          }
          if ($unit === 'm') {
            $ex->addSet((float) $row[self::DISTANCE] / 1000, $row[self::TIME]);
          } else {
            $ex->addSet((float) $row[self::DISTANCE], $row[self::TIME], $unit);
          }
        } else {
          $ex = $log->timedExercise($name, $category);
          $ex->addSet($row[self::TIME]);
        }
      }
    }
    //var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
    return $coll;
  }

}
