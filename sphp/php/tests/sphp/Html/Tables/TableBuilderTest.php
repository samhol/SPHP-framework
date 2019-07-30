<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Tables;

use PHPUnit\Framework\TestCase;

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
    $this->assertNull($tableBuilder->getTheadData());
    $this->assertNull($tableBuilder->getTbodyData());
    $this->assertNull($tableBuilder->getTfootData());
    return $tableBuilder;
  }

  /**
   * @depends testConstructor
   * @param  TableBuilder $tableBuilder
   */
  public function testBodyDataManipulation(TableBuilder $tableBuilder) {
    $this->assertSame($tableBuilder, $tableBuilder->setTbodyData([['a', 'b']]));
    $this->assertEquals([['a', 'b']], $tableBuilder->getTbodyData());
    $table = new Table();
    $this->assertSame($table, $tableBuilder->buildTbody($table));
    $this->assertCount(1, $table->tbody());
    foreach ($table->tbody() as $index => $row) {
      $this->assertSame($table->tbody()->getRow($index), $row);
    }
  }

  /**
   * @depends testConstructor
   * @param  TableBuilder $tableBuilder
   */
  public function testTfootDataManipulation(TableBuilder $tableBuilder) {
    $this->assertSame($tableBuilder, $tableBuilder->setTfootData([['a', 'b']]));
    $this->assertEquals([['a', 'b']], $tableBuilder->getTfootData());
    $table = new Table();
    $this->assertSame($table, $tableBuilder->buildFoot($table));
    $this->assertCount(1, $table->tfoot());
    foreach ($table->tfoot() as $index => $row) {
      $this->assertSame($table->tfoot()->getRow($index), $row);
    }
  }

}
