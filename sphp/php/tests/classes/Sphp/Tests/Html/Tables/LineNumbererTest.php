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
use Sphp\Html\Tables\LineNumberer;
use Sphp\Html\Tables\Table;

/**
 * Description of LineNumbererTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class LineNumbererTest extends TestCase {

  public function constructorParameters(): array {
    return [
        [LineNumberer::LEFT, 1, '#'],
        [LineNumberer::RIGHT, 1, 'Row: '],
        [LineNumberer::LEFT | LineNumberer::RIGHT, 1, '#'],
        [LineNumberer::NONE, 1, '#'],
    ];
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  int $side
   * @param  int $start
   * @param  string $label
   * @return void
   */
  public function testConstructor(int $side, int $start, string $label): void {
    $numberer = new LineNumberer($side, $start, $label);
    $this->assertSame($side, $numberer->getSide());
    $this->assertSame($start, $numberer->getStart());
    $this->assertSame($label, $numberer->getLabel());
  }

  /**
   * @return void
   */
  public function testOptionSetting(): void {
    $numberer = new LineNumberer();
    $this->assertSame($numberer, $numberer->setFirstLineNumber(10));
    $this->assertSame(10, $numberer->getFirstLineNumber());
    $this->assertSame($numberer, $numberer->setLabel('¤'));
    $this->assertSame('¤', $numberer->getLabel());
    $this->assertSame($numberer, $numberer->setSide(LineNumberer::LEFT));
    $this->assertSame(LineNumberer::LEFT, $numberer->getSide());
    $this->assertSame($numberer, $numberer->setSide(LineNumberer::RIGHT));
    $this->assertSame(LineNumberer::RIGHT, $numberer->getSide());
    $this->assertSame($numberer, $numberer->setSide(LineNumberer::LEFT | LineNumberer::RIGHT));
    $this->assertSame(LineNumberer::LEFT | LineNumberer::RIGHT, $numberer->getSide());
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

  public function parameterSets(): array {
    return [
        [1, 'Row '],
        [3, '*']
    ];
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  int $side
   * @param  int $start
   * @param  string $label
   * @return void
   */
  public function testUseInTable(int $side, int $start, string $label) {
    $numberer = new LineNumberer($side, $start, $label);
    $table = $this->buildTable();
    $numberer->useInTable($table);
    if ($side & LineNumberer::LEFT) {
      $row = $table->thead()->getRow(0);
      $this->assertSame("<th scope=\"col\">$label</th>", (string) $row[0]);
    }
    if ($side & LineNumberer::RIGHT) {
      $row = $table->thead()->getRow(0);
      $this->assertSame("<th scope=\"col\">$label</th>", (string) $row[$row->count() - 1]);
    }
    $num = $numberer->getFirstLineNumber();
    foreach ($table->tbody() as $row) {
      if ($side & LineNumberer::LEFT) {
        $th = $row[0];
        $this->assertInstanceOf(\Sphp\Html\Tables\Th::class, $th);
        $this->assertSame("<th scope=\"row\">$num.</th>", (string) $th);
      }
      if ($side & LineNumberer::RIGHT) {
        $th = $row[$row->count() - 1];
        $this->assertInstanceOf(\Sphp\Html\Tables\Th::class, $th);
        $this->assertSame("<th scope=\"row\">$num.</th>", (string) $th);
      }
      ++$num;
    }
    $this->assertSame($numberer, $numberer->setFirstLineNumber(10));
    $this->assertSame(10, $numberer->getFirstLineNumber());
    $this->assertSame($numberer, $numberer->setLabel('¤'));
    $this->assertSame('¤', $numberer->getLabel());
  }

  /**
   * @dataProvider constructorParameters
   * 
   * @param  int $side
   * @param  int $start
   * @param  string $label
   * @return void
   */
  public function testInvoke(int $side, int $start, string $label) {
    $numberer = new LineNumberer($side, $start, $label);
    $this->assertEquals($numberer($this->buildTable()), $numberer->useInTable($this->buildTable()));
  }

}
