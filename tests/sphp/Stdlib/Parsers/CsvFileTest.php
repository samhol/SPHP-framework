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
    //var_dump($actual);
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
      if (array_key_exists($k, $actual)) {
      $this->assertEquals($actual[$k], $row);
      }
    }
  }

  public function testGetChunk() {
    $csvObj = new CsvFile('./tests/files/test.csv');
    $csvArray = $csvObj->toArray();
    $chunk = $csvObj->getChunk(2, 5);
    $this->assertEquals(array_slice($csvArray, 2, 5, true), $chunk);
   // print_r(array_slice($csvArray, 5, true));
    return $csvObj;
  }

  /**
   * @depends testGetChunk
   * @param   CsvFile $csvObj
   */
  public function t2estSeek(CsvFile $csvObj) {
    $csvObj->rewind();
    foreach ($csvObj->toArray() as $key => $row) {
      //var_dump($key, $row);
      if ($csvObj->valid()) {
        $actualRow = $csvObj->seek($key)->current();
        $this->assertEquals($row, $actualRow);
      }
    }
  }

  /**
   * @expectedException \Sphp\Exceptions\OutOfRangeException
   */
  public function testOverflowSeek() {
    $csvObj = new CsvFile('./tests/files/test.csv');
    $csvObj->seek(100);
  }

  /**
   * @expectedException \Sphp\Exceptions\LogicException
   */
  public function testNegativeSeek() {
    $csvObj = new CsvFile('./tests/files/test.csv');
    $csvObj->seek(-1);
  }

}
