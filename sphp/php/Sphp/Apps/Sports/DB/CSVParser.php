<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Apps\Sports\DB;

use Sphp\Stdlib\Parsers\CsvFile;

/**
 * Implements a factory for Diary creation from FitNotes application data
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class CSVParser {

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

  /**
   * @var CsvFile
   */
  private CsvFile $csv;

  /**
   * @var FitNotesRow
   */
  private $rowParser;

  /**
   * Constructor
   * 
   * @param string $csvPath
   */
  public function __construct(string $csvPath) {
    $this->rowParser = new FitNotesRow();
    $this->csv = new CsvFile($csvPath);
  }

  /**
   * Destructor
   */
  public function __destruct() {
    unset($this->csv, $this->rowParser);
  }

  public function parseRawData(int $offset = 1, bool $clean = true): array {
    $rawData = $this->csv->getChunk($offset);
    if ($clean) {
      foreach ($rawData as $key => $row) {
        $rawData[$key] = $this->rowParser->parseDatabaseRow($row);
      }
    }
    return $rawData;
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
