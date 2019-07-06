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
use Sphp\Stdlib\Filesystem;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\OutOfRangeException;
use Sphp\Exceptions\LogicException;

class CsvFileTest extends TestCase {

  public function testAppending() {
    $spl = Filesystem::mkFile('./sphp/php/tests/temp/bar.csv');
    $csvObj = new CsvFile('./sphp/php/tests/temp/bar.csv');
    $csvObj->appendRow(['foo', 'bar', 'baz']);
    $fileAsArray = $csvObj->toArray();
    $this->assertEquals(['foo', 'bar', 'baz'], $fileAsArray[0]);
    unset($spl, $csvObj);
    Filesystem::rmFile('./sphp/php/tests/temp/bar.csv');
  }

  public function testInvalidFileName() {
    $this->expectException(FileSystemException::class);
    new CsvFile('foo.csv');
  }

  public function testGetHeaderRow() {
    $fileObj = new \SplFileObject('./sphp/php/tests/files/test.csv');
    $expected = $fileObj->fgetcsv();
    $actual = (new CsvFile('./sphp/php/tests/files/test.csv'))->getHeaderRow();
    $this->assertEquals($expected, $actual);
  }

  public function testToArrayAndIterator() {
    $row = 0;
    $fileObj = new \SplFileObject('./sphp/php/tests/files/test.csv');
    $csvObj = new CsvFile('./sphp/php/tests/files/test.csv');
    $actual = $csvObj->toArray();
    //var_dump($actual);
    if (($handle = fopen('./sphp/php/tests/files/test.csv', 'r')) !== false) {
      while (($data = fgetcsv($handle, 1000, ',')) !== false) {
        $this->assertEquals($data, $actual[$row]);
        $this->assertEquals($data, $actual[$row]);
        //$this->assertEquals($data, $csvObj->current());
        //$csvObj->next();
        $row++;
      }
      fclose($handle);
    }
    //print_r($actual);
    foreach ($csvObj as $k => $row) {
      if (array_key_exists($k, $actual)) {
        $this->assertEquals($actual[$k], $row);
      }
    }
  }

  public function testGetChunk() {
    $csvObj = new CsvFile('./sphp/php/tests/files/test.csv');
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
  public function testSeek(CsvFile $csvObj) {
    $csvObj->rewind();
    foreach ($csvObj->toArray() as $key => $row) {
      //var_dump($key, $row);
      if ($csvObj->valid()) {
        $actualRow = $csvObj->seek($key)->current();
        $this->assertEquals($row, $actualRow);
      }
    }
  }

  public function testOverflowSeek() {
    $this->expectException(OutOfRangeException::class);
    $csvObj = new CsvFile('./sphp/php/tests/files/test.csv');
    $csvObj->seek(100);
  }

  public function testNegativeSeek() {
    $this->expectException(LogicException::class);
    $csvObj = new CsvFile('./sphp/php/tests/files/test.csv');
    $csvObj->seek(-1);
  }

}
