<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\DateTime\Calendars\Diaries\Sports;

use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Date;
use Sphp\DateTime\Calendars\Diaries\Diary;
use Sphp\DateTime\Calendars\Diaries\DiaryInterface;

/**
 * Implements a factory for Diary creation from FitNotes application data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FitNotes {

  /**
   * Parses exercises from FitNotes csv file
   * 
   * @param  string $path path to FitNotes csv file
   * @return DiaryInterface
   */
  public static function fromCsv(string $path): DiaryInterface {
    $rawData = Parser::csv()->arrayFromFile($path); //print_r($rawData);
    array_shift($rawData);
    $coll = new Diary();
    $log = $date = null;
    $rawDate = '';

    //var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
    foreach ($rawData as $exersice) {
      if (!isset($date) || $rawDate !== $exersice[0]) {
        $rawDate = $exersice[0];
        $date = new Date($rawDate);
        $log = new WorkoutLog($date);
        $coll->insertLog($log);
      }
      $name = $exersice[1];
      $category = $exersice[2];
      if ($exersice[3] > 0 && $exersice[4] > 0) {
        $ex = $log->setWeightLiftingExercise($name, $category);
        $ex->addSet((float) $exersice[3], (int) $exersice[4]);
      } else if (!empty($exersice[7])) {
        if ($exersice[5] > 0) {
          $ex = $log->setDistanceAndTimeExercise($name, $category);
          if ($exersice[6] !== '') {
            $unit = $exersice[6];
          } else {
            $unit = 'km';
          }
          $ex->addSet((float) $exersice[5], $exersice[7], $unit);
        } else {
          $ex = $log->setTimedExercise($name, $category);
          $ex->addSet($exersice[7]);
        }
      }
    }
    //var_dump(\Sphp\Stdlib\StopWatch::getEcecutionTime());
    return $coll;
  }

}
