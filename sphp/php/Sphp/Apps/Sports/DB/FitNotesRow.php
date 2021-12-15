<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\DB;

/**
 * Class FitNotesRow
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class FitNotesRow {

  const DATE = 0;
  const EXERCISE = 1;
  const CATEGORY = 2;
  const WEIGHT = 3;
  const REPS = 4;
  const DISTANCE = 5;
  const DISTANCE_UNIT = 6;
  const TIME = 7;
  const COMMENT = 9;
  const TYPE_INDEX = 8;
  protected const DT_EX = 1;
  protected const T_EX = 2;
  protected const WR_EX = 3;
  protected const BWR_EX = 4;

  public function parseDatabaseRow(array $row): array {
    $row[self::TIME] = $this->parseTimeToInt($row[self::TIME]);
    //$row[self::DISTANCE] = ($row[self::DISTANCE] === 0) ? null : $row[self::DISTANCE];
    $row[self::DISTANCE] = $this->parseDistance($row[self::DISTANCE], $row[self::DISTANCE_UNIT]);
    unset($row[self::DISTANCE_UNIT]);
    $row[] = $this->parseType($row);
    return array_values($row);
  }

  protected function parseType(array $row): int {
    $type = 0;
    if (self::isDistanceAndTimeExerciseData($row)) {
      $type = self::DT_EX;
    }
    if (self::isTimedExerciseData($row)) {
      $type = self::T_EX;
    }
    if (self::isWeightLiftingExerciseData($row)) {
      $type = self::WR_EX;
    }
    if (self::isBodyWeightExerciseData($row)) {
      $type = self::BWR_EX;
    }
    return $type;
  }

  public function parseTimeToInt(string $time): ?int {
    $parts = explode(':', $time);
    if (count($parts) === 3) {
      $out = 3600 * $parts[0] + 60 * $parts[1] + $parts[2];
    } else {
      $out = null;
    }
    // var_dump($out);
    return $out;
  }

  public function parseDistance(string $distance, string $unit): ?float {
    $pre = ($distance == 0) ? null : (float) $distance;
    if ($unit === 'km') {
      $pre = 1000 * $pre;
    }
    /* if($pre > 0) {
      var_dump($pre,$unit);
      } */
    return $pre;
  }

  public static function isTimedExerciseData(array $data): bool {
    return !empty($data[self::TIME]) && (float) $data[self::DISTANCE] <= 0;
  }

  public static function isDistanceAndTimeExerciseData(array $data): bool {
    return $data[self::DISTANCE] > 0 && $data[self::TIME] !== '';
  }

  public static function isWeightLiftingExerciseData(array $data): bool {
    return $data[self::WEIGHT] >= 0 && $data[self::REPS] > 0;
  }

  public static function isBodyWeightExerciseData(array $data): bool {
    return $data[self::WEIGHT] <= 0 && $data[self::REPS] > 0;
  }

}
