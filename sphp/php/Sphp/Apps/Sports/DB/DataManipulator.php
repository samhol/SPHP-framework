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
 * Class Fitnotes
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class DataManipulator extends DB {

  public function appendOnlyNewRows(string $csvPath): int {
    $rawData = new CSVParser($csvPath);

    $rows = $this->count();
    $rawRows = $rawData->parseRawData($rows + 1);
    //print_r($rawRows);
    $added = 0;
    foreach ($rawRows as $row) {
      //echo $row[8];
      if (true) {
        
      }
      if ($this->insertRow($row)) {
        $added++;
      }
    }
    return $added;
  }

  protected function insertRow(array $row): bool {
    $added = false;
    $stmt = $this->getPdo()->prepare("
      INSERT INTO fitnotes 
            (date, exercise, cat, weight, reps, dist, time, type) 
            VALUES (?,?,?,?,?,?,?,?)");
    //$row[] = $this->parseType($row);
    try {
      // $pdo->beginTransaction();
      print_r($row);
      $added = $stmt->execute($row);
      var_dump($added);
      // $pdo->commit();
    } catch (\Exception $e) {
      // $pdo->rollback();
      echo $e->getMessage();
    }
    return $added;
  }

  public function replaceData(string $csvPath): int {
    $this->getPdo()->query('TRUNCATE TABLE fitnotes')->execute();
    $csvData = new CSVParser($csvPath);
    $rawData = $csvData->parseRawData();
    $added = 0;
    foreach ($rawData as $row) {
      if ($this->insertRow($row)) {
        $added++;
      }
    }
    return $added;
  }

}
