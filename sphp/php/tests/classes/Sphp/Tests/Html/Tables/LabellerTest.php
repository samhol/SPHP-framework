<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Tables;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Tables\Labeller;
use Sphp\Html\Tables\Table;

/**
 * Description of LineNumbererTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LabellerTest extends TestCase {

  /**
   * @return Labeller
   */
  public function testSetup(): Labeller {
    $labeller = new Labeller(range('a', 'e'));
    $this->assertSame($labeller, $labeller->setLabels(range('B', 'F')));
    $this->assertSame($labeller, $labeller->setLabelForColumn('first', 0));
    $this->assertSame($labeller, $labeller->setLabelForColumn('second', 1));
    $this->assertSame($labeller, $labeller->setLabelForColumn('third', 2));
    $this->assertSame($labeller, $labeller->setLabelForColumn('fourth', 3));
    return $labeller;
  }

  public function buildTable(): Table {
    $table = $this->buildTableWithBodyOnly();
    $table->useThead();
    $table->thead()->appendHeaderRow(range('a', 'e'));
    $table->useTfoot();
    $table->tfoot()->appendHeaderRow(range('a', 'e'));
    return $table;
  }

  public function buildTableWithBodyOnly(): Table {
    $table = new Table();
    $table->useTbody();
    $table->tbody()->appendBodyRow(range(1, 5));
    $table->tbody()->appendBodyRow(range(1, 5));
    $table->tbody()->appendBodyRow(range(1, 5));
    return $table;
  }

  /**
   * @depends testSetup
   * 
   * @param  int $start
   * @param  string $label
   * @return void
   */
  public function testUseInTable(Labeller $labeller) {
    $table = $this->buildTable();
    $labeller->useInTable($table);
    foreach ($table->tbody()->getComponentsByObjectType(\Sphp\Html\Tables\Tr::class) as $tr) {
      $this->assertSame('first', $tr[0]->getAttribute('data-label'));
      $this->assertSame('second', $tr[1]->getAttribute('data-label'));
      $this->assertSame('third', $tr[2]->getAttribute('data-label'));
      $this->assertSame('fourth', $tr[3]->getAttribute('data-label'));
    }
  }

  /**
   * @depends testSetup
   * 
   * @param  Labeller $labeller
   * @return void
   */
  public function testInvoke(Labeller $labeller): void {
    $this->assertEquals($labeller($this->buildTable()), $labeller->useInTable($this->buildTable()));
  }

}
