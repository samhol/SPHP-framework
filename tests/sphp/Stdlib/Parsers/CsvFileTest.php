<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Stdlib\Parsers;

use PHPUnit\Framework\TestCase;

class CsvFileTest extends TestCase {

  public function testGetHeaderRow() {
    $fileObj = new \SplFileObject('./tests/files/test.csv');
    $expected = $fileObj->fgetcsv();
    $actual = (new CsvFile('./tests/files/test.csv'))->getHeaderRow();
    $this->assertEquals($expected, $actual);
  }

  public function testToArrayAndIterator() {
    $row = 0;
    $fileObj = new \SplFileObject('./tests/files/test.csv');
    $csvObj = new CsvFile('./tests/files/test.csv');
    $actual = $csvObj->toArray();
    if (($handle = fopen('./tests/files/test.csv', 'r')) !== false) {
      while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $this->assertEquals($data, $actual[$row]);
        $this->assertEquals($data, $actual[$row]);
        //$this->assertEquals($data, $csvObj->current());
        //$csvObj->next();
        $row++;
      }
      fclose($handle);
    }
    print_r($actual);
    foreach ($csvObj as $k => $row) {
      $this->assertEquals($actual[$k], $row);
    }
  }

}
