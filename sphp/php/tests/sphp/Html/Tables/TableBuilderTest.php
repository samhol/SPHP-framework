<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Tables\TableBuilder;
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Th;
use Sphp\Html\Tables\Td;
use Sphp\Html\Tables\Caption;

/**
 * Description of TableBuilderTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class TableBuilderTest extends TestCase {

  public function testConstructor(): TableBuilder {
    $tableBuilder = new TableBuilder();
    $this->assertEmpty($tableBuilder->getTheadData());
    $this->assertEmpty($tableBuilder->getTbodyData());
    $this->assertEmpty($tableBuilder->getTfootData());
    return $tableBuilder;
  }

  public function tbodyDataGen(): array {
    $data[] = range(1, 5);
    $data[] = range(1, 5);
    $data[] = range(1, 5);
    $data[] = range(1, 5);
    return $data;
  }

  public function theadDataGen(): array {
    return range('A', 'E');
  }

  public function tfootDataGen(): array {
    return range('a', 'e');
  }

  /**
   * @depends testConstructor
   * 
   * @param  TableBuilder $tableBuilder
   * @return TableBuilder
   */
  public function testDataSetters(TableBuilder $tableBuilder): TableBuilder {
    $tbodyData = $this->tbodyDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTbodyData($tbodyData));
    $this->assertEquals($tbodyData, $tableBuilder->getTbodyData());
    $theadData = $this->theadDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTheadData($theadData));
    $this->assertEquals($theadData, $tableBuilder->getTheadData());
    $tfootData = $this->tfootDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTfootData($tfootData));
    $this->assertEquals($tfootData, $tableBuilder->getTfootData());
    return $tableBuilder;
  }

  /**
   * @depends testDataSetters
   * 
   * @param  TableBuilder $tableBuilder
   */
  public function testTableFilters(TableBuilder $tableBuilder): TableBuilder {
    $filter = function (Table $table) {
      $table->setCaption('foobar');
    };
    $tableBuilder->addTableFilter($filter);
    $dummy = new Caption('foobar');
    $table = $tableBuilder->buildTable();
    $this->assertEquals($dummy, $table->caption());
    return $tableBuilder;
  }

  /**
   * @depends testTableFilters
   * 
   * @param  TableBuilder $tableBuilder
   */
  public function testBuildTbody(TableBuilder $tableBuilder): TableBuilder {
    $data = $this->tbodyDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTbodyData($data));
    $this->assertEquals($data, $tableBuilder->getTbodyData());
    $tbody = $tableBuilder->buildTbody();
    $this->assertCount(count($data), $tbody);
    foreach ($tbody as $rowNo => $tr) {
      $tr = $tbody->getRow($rowNo);
      $this->assertArrayHasKey($rowNo, $data);
      foreach ($tr as $tdNo => $td) {
        $this->assertInstanceOf(Td::class, $td);
        $this->assertArrayHasKey($tdNo, $data[$rowNo]);
        $this->assertSame((string) $data[$rowNo][$tdNo], $td->contentToString());
      }
    }
    return $tableBuilder;
  }

  /**
   * @depends testBuildTbody
   *
   * @param  TableBuilder $tableBuilder
   * @return TableBuilder
   */
  public function testBuildThead(TableBuilder $tableBuilder): TableBuilder {
    $data = $this->theadDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTheadData($data));
    $this->assertEquals($data, $tableBuilder->getTheadData());
    $thead = $tableBuilder->buildThead();
    $this->assertEquals($thead, $tableBuilder->buildThead());
    $this->assertCount(1, $thead);
    foreach ($thead->getRow(0) as $index => $row) {
      $this->assertInstanceOf(Th::class, $row);
      $this->assertSame("<th>{$data[$index]}</th>", (string) $row);
    }
    return $tableBuilder;
  }

  /**
   * @depends testBuildThead
   * 
   * @param  TableBuilder $tableBuilder
   * @return TableBuilder
   */
  public function testBuildTfoot(TableBuilder $tableBuilder): TableBuilder {
    $data = $this->tfootDataGen();
    $this->assertSame($tableBuilder, $tableBuilder->setTfootData($data));
    $this->assertEquals($data, $tableBuilder->getTfootData());
    $tfoot = $tableBuilder->buildTfoot();
    $this->assertCount(1, $tfoot);
    $this->assertEquals($tfoot, $tableBuilder->buildTfoot());
    foreach ($tfoot->getRow(0) as $index => $th) {
      $this->assertInstanceOf(Th::class, $th);
      $this->assertSame("<th>{$data[$index]}</th>", (string) $th);
    }
    return $tableBuilder;
  }

  /**
   * @depends testBuildTfoot
   * 
   * @param  TableBuilder $tableBuilder
   * @return void
   */
  public function testBuildTable(TableBuilder $tableBuilder): void {
    $bodyData = $this->tbodyDataGen();
    $table = new Table();
    $tableBuilder->buildTable($table);
    $this->assertEquals($table, $tableBuilder->buildTable());
    $this->assertEquals((string) $table, $tableBuilder->getHtml());
    foreach ($bodyData as $rowIndex => $row) {
      $tr = $table->tbody()->getRow($rowIndex);
      foreach ($row as $cellIndex => $cell) {
        $this->assertSame("<td>$cell</td>", (string) $tr->getCell($cellIndex));
      }
    }
    unset($tableBuilder);
  }

}
