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

use Countable;
use PDO;
use Sphp\Apps\Calendars\Diaries\Diary;
use Sphp\Apps\Calendars\Diaries\DiaryDateInterface;
use Sphp\DateTime\ImmutableDate;
use Sphp\DateTime\Date;
use Sphp\Apps\Sports\Workouts\Workout;
use Sphp\DateTime\Interval;
use Sphp\Apps\Sports\Exceptions\FitNotesException;

/**
 * The DB class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DB implements Countable, Diary {

  protected const DT_EX = 1;
  protected const T_EX = 2;
  protected const WR_EX = 3;
  protected const BWR_EX = 4;
 
  private PDO $pdo;

  /**
   * Constructor
   * 
   * @param PDO $pdo
   */
  public function __construct(PDO $pdo) {
    $this->pdo = $pdo;
    $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    $this->pdo->setAttribute(PDO::ATTR_DEFAULT_FETCH_MODE, PDO::FETCH_ASSOC);
    $this->pdo->setAttribute(PDO::ATTR_EMULATE_PREPARES, true);
  }

  public function __destruct() {
    unset($this->pdo);
  }

  public function getPdo(): PDO {
    return $this->pdo;
  }

  public function count(): int {
    $stmt = $this->pdo->prepare('SELECT COUNT(*) FROM fitnotes');
    $stmt->execute();
    $result = $stmt->fetchColumn();
    return (int) $result;
  }

  /**
   *  
   * @param  Date $date1
   * @param  Date $date2
   * @return array
   * @throws DiaryDateInterface
   */
  public function getWorkoutsBetwwen(Date $date1, Date $date2): array {
    $stmt = $this->pdo->prepare('
      SELECT 
        type,date,exercise,cat,weight,reps,dist,time 
        FROM fitnotes 
        WHERE date BETWEEN CAST(:date1 AS DATE) AND CAST(:date2 AS DATE)');
    $d1 = $date1->format('Y-m-d');
    $d2 = $date2->format('Y-m-d');
    $stmt->bindParam(':date1', $d1);
    $stmt->bindParam(':date2', $d2);
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $this->parseDBRows($result);
  }

  public function getLast(int $count): array {
    $stmt = $this->pdo->prepare('
      WITH 
       dates AS (SELECT date FROM training_days ORDER BY date DESC LIMIT 0,' . $count . ')
      SELECT        
       type,fitnotes.date,exercise,cat,weight,reps,dist,time 
       FROM fitnotes, dates
       WHERE fitnotes.date = dates.date');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $this->parseDBRows($result);
  }

  public function getClosest(Date $date, int $count = 10): array {
    $stmt = $this->pdo->prepare('
      WITH 
       dates AS (
        SELECT date, ABS(DATEDIFF("' . $date->format('Y-m-d') . '", date)) AS diff 
         FROM `training_days` 
         ORDER BY diff ASC 
         LIMIT 0,' . $count . ')
       SELECT        
        type,fitnotes.date,exercise,cat,weight,reps,dist,time 
        FROM fitnotes, dates
        WHERE fitnotes.date = dates.date ORDER BY date ASC ');
    $stmt->execute();
    $result = $stmt->fetchAll();
    return $this->parseDBRows($result);
  }

  /**
   * 
   * @param  ImmutableDate $date
   * @throws DiaryDateInterface
   */
  public function getWorkouts(...$date): array {
    $out = [];
    foreach ($date as $d) {
      $workout = $this->getWorkout($d);
      if ($workout !== null) {
        $out[] = $workout;
      }
    }

    return $out;
  }

  public function hasWorkout(Date $date): bool {
    $stmt = $this->pdo->prepare('
      SELECT 
        COUNT(*) > 1
        FROM fitnotes WHERE date = :date');
    $dateStr = $date->format('Y-m-d');
    $stmt->bindParam(':date', $dateStr);
    $stmt->execute();
    $result = $stmt->fetchColumn();

    return (bool) $result;
  }

  /**
   * 
   * @param  Date $date
   * @throws DiaryDateInterface
   */
  public function getWorkout(Date $date): ?Workout {
    $stmt = $this->pdo->prepare('
      SELECT 
        type,date,exercise,cat,weight,reps,dist,time 
        FROM fitnotes WHERE date = :date');
    $dateStr = $date->format('Y-m-d');
    $stmt->bindParam(':date', $dateStr);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $wo = new Workout($date);
    if (count($result) > 0) {
      $wo = $this->parseDBRows($result)[$dateStr];
    }
    return $wo;
  }

  /**
   * 
   * @param  ImmutableDate $date
   * @throws DiaryDateInterface
   */
  public function getDate($date): DiaryDateInterface {
    $date = ImmutableDate::from($date);
    $stmt = $this->pdo->prepare('
      SELECT 
        type,date,exercise,cat,weight,reps,dist,time 
        FROM fitnotes WHERE date = :date');
    $dateStr = $date->format('Y-m-d');
    $stmt->bindParam(':date', $dateStr);
    $stmt->execute();
    $result = $stmt->fetchAll();
    $diaryDate = new \Sphp\Apps\Calendars\Diaries\DiaryDate($date);
    if (count($result) > 0) {
      $diaryDate->merge($this->parseDBRows($result));
    }
    return $diaryDate;
  }

  /**
   * 
   * @param  array $rows
   * @return Workout[]
   * @throws FitNotesException
   */
  protected function parseDBRows(array $rows): array {
    $workouts = [];
    // echo '<pre>';
    //print_r($rows);
    //  echo '</pre>';
    foreach ($rows as $row) {
      $type = (int) $row['type'];
      $dateStr = $row['date'];
      if (!array_key_exists($dateStr, $workouts)) {
        $workout = new Workout(ImmutableDate::from($dateStr));
        $workouts[$dateStr] = $workout;
      }
      if ($type === self::DT_EX) {
        $ex = $workout->distanceAndTimeExercise($row['exercise'], $row['cat']);
        $ex->addSet(Interval::fromSeconds((float) $row['time']), (float) $row['dist']);
      } else if ($type === self::WR_EX) {
        $ex = $workout->weightLiftingExercise($row['exercise'], $row['cat']);
        $ex->addSet((float) $row['weight'], (int) $row['reps']);
      } else if ($type === self::T_EX) {
        $ex = $workout->timedExercise($row['exercise'], $row['cat']);
        $ex->addSet(Interval::fromSeconds((float) $row['time']));
      } else if ($type === self::BWR_EX) {
        $ex = $workout->bodyWeightExercise($row['exercise'], $row['cat']);
        $ex->addSet((int) $row['reps']);
      } else {
        // var_dump($row);
        throw new FitNotesException('Invalid FitNotes database row detected');
      }
    }
    return $workouts;
  }

}
