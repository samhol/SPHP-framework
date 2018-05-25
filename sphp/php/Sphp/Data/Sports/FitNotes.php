<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

namespace Sphp\Data\Sports;

use Sphp\Stdlib\Parsers\Parser;
use Sphp\DateTime\Date;

/**
 * Description of FitNotes
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
   * @return ExerciseDayCollection
   */
  public static function fromCsv(string $path): ExerciseDayCollection {
    $rawData = Parser::csv()->arrayFromFile($path); //print_r($rawData);
    array_shift($rawData);

    $coll = new ExerciseDayCollection();
    foreach ($rawData as $exersice) {
      $date = new Date($exersice[0]);
      if (!$coll->dateExists($date)) {
        $obj = new ExerciseDay($date);
        $coll->setDay($obj);
      } else {
        $obj = $coll->getDay($date);
      }
      $name = $exersice[1];
      $category = $exersice[2];
      if ($exersice[3] > 0 && $exersice[4] > 0) {
        $ex = $obj->weightLifting($name, $category);
        $ex->addSet((float) $exersice[3], (int) $exersice[4]);
      } else if (!empty($exersice[7])) {
        if ($exersice[5] > 0) {
          $ex = $obj->distanceAndTime($name, $category);
          if ($exersice[6] !== '') {
            $unit = $exersice[6];
          } else {
            $unit = 'km';
          }
          $ex->addSet((float) $exersice[5], $exersice[7], $unit);
        } else {
          $ex = $obj->timedExercise($name, $category);
          $ex->addSet($exersice[7]);
        }
      }
    }
    return $coll;
  }

}
