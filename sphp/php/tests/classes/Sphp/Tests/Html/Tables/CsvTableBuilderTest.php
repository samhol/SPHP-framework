<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Tables\CsvTablebuilder;
use Sphp\Html\Tables\LineNumberer;
use Sphp\Stdlib\Parsers\CsvFile;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Td;

/**
 * Class CsvTableBuilderTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class CsvTableBuilderTest extends TestCase {

  public function constructorParameters(): array {
    $params = [];
    $params[] = [false, 0, 1];
    return $params;
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  bool $useHead
   * @param  int $offset
   * @param  int $count
   * @return void
   */
  public function testConstructor(bool $useHead = false, int $offset = 0, int $count = -1) {
    $builder = new CsvTablebuilder($useHead, $offset, $count);
    $this->assertSame($useHead, $builder->getUseHead());
    $this->assertSame($offset, $builder->getOffset());
    $this->assertSame($count, $builder->getRowCount());
  }

  public function setterParameters(): array {
    $params = [];
    $params[] = [false, 0, 1, LineNumberer::LEFT];
    $params[] = [true, 0, 1, LineNumberer::RIGHT];
    return $params;
  }

  /**
   * @dataProvider setterParameters
   * 
   * @param  bool $useHead
   * @param  int $offset
   * @param  int $count
   * @return void
   */
  public function testSetters(bool $useHead, int $offset, int $count, int $linenumbers): void {
    $builder = new CsvTablebuilder();
    $this->assertSame($builder, $builder->setRange($offset, $count));
    $this->assertSame($offset, $builder->getOffset());
    $this->assertSame($count, $builder->getRowCount());
    $this->assertSame($builder, $builder->setUseHead($useHead));
    $this->assertSame($useHead, $builder->getUseHead());
    $this->assertSame($builder, $builder->useLinenumbers($linenumbers));
    $this->assertSame($linenumbers, $builder->usesLinenumbers());
  }

  protected function checkHeading(CsvFile $csvData, Table $table, int $linenumbers): void {
    $headings = $csvData->getHeaderRow();
    if (($linenumbers & LineNumberer::LEFT)) {
      array_unshift($headings, '#');
    }
    $tr = $table->thead()->getRow(0);
    foreach ($headings as $key => $value) {
      $this->assertEquals((string) $value, (string) $tr[$key]->contentToString());
    }
  }

  public function buildParams(): array {
    $data = [];
    $data[] = [true, LineNumberer::LEFT, 0, 9];
    $data[] = [false, LineNumberer::LEFT, 2, 5];
    return $data;
  }

  /**
   * @dataProvider buildParams
   * 
   * @param  bool $useHead
   * @return void
   */
  public function testBuild(bool $useHead, int $linenumbers, int $from, int $to): void {
    $builder = new CsvTablebuilder();
    $builder->setUseHead($useHead);
    $builder->useLinenumbers($linenumbers)->setRange($from, $to);

    // $builder->setUseHead(true);
    $this->assertSame($builder, $builder->useFile('./sphp/php/tests/files/10.csv'));
    $table = $builder->build();
    $csv = new CsvFile('./sphp/php/tests/files/10.csv');
    $csvData = $csv->getSlice($from, $to);
    //  $csvData = $csv->toArray();
    if ($useHead) {
      //$headings = array_shift($csvData);
      $this->checkHeading($csv, $table, $linenumbers);
      if ($from === 0) {
        array_shift($csvData);
      }
    }
    $tbody = $table->tbody();
    $rowNo = 0;
    //print_r($csvData);
    foreach ($csvData as $row) {
      $tr = $tbody->getRow($rowNo);
      // echo "$rowNo: $tr\n";
      foreach ($row as $cellNo => $value) {
        if (($linenumbers & LineNumberer::LEFT)) {
          $cellNo += 1;
        }
        $td = $tr[$cellNo];
        $this->assertInstanceOf(Td::class, $td);
        $this->assertSame("<td>$value</td>", (string) $td);
      }
      ++$rowNo;
    }
  }

}
