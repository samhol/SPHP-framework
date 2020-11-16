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
use Sphp\Html\Tables\Table;
use Sphp\Html\Tables\Caption;
use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Tbody;
use Sphp\Html\Tables\Thead;
use Sphp\Html\Tables\Tfoot;
use Sphp\Html\Tables\TableContent;

class TableTest extends TestCase {

  public function createEmptyTable(): Table {
    return new Table();
  }

  /**
   * @return array
   */
  public function bodytData(): array {
    return [
        [
            [
                [range('a', 'b'), range(1, 2), range('c', 'd')],
                ["daisy", 0.75, 25],
                ["orchid", 1.15, 7]
            ]
        ]
    ];
  }

  /**
   * @return void
   */
  public function testSetContent(): void {
    $table = $this->createEmptyTable();
    $this->assertSame("$table", '<table></table>');
    $caption = new Caption('caption');
    $table->setContent($caption);
    $this->assertSame("$table", "<table>$caption</table>");
    $thead = new Thead();
    $thead->appendHeaderRow(['a']);
    $table->setContent($thead);
    $this->assertSame("$table", "<table>{$caption}{$thead}</table>");
    $tbody = new Tbody();
    $tbody->appendBodyRow(range(1, 5));
    $table->setContent($tbody);
    $this->assertCount(2, $table);
    $tfoot = new Tfoot();
    $tfoot->appendBodyRow(['c']);
    $table->setContent($tfoot);
    $this->assertCount(3, $table);
    $this->assertSame("$table", "<table>{$caption}{$thead}{$tbody}{$tfoot}</table>");
    $table->setContent($tr = Tr::fromTds(range(1, 5)));
    $this->assertSame($tr, $table->tbody()->getRow(1));
    $this->assertSame("$table", "<table>{$caption}{$thead}{$tbody}{$tfoot}</table>");
  }

  public function testTheadMethods() {
    $table = $this->createEmptyTable();
    $this->assertNull($table->thead());
    $thead = new Thead();
    $this->assertSame($table, $table->setThead($thead));
    $this->assertSame($thead, $table->thead());
    $this->assertSame($table, $table->setThead(null));
    $this->assertNull($table->thead());
    $this->assertSame($table, $table->useThead());
    $this->assertInstanceOf(Thead::class, $table->thead());
    $this->assertSame($table, $table->useThead(false));
    $this->assertNull($table->thead());
  }

  public function testCaptionMethods() {
    $table = $this->createEmptyTable();
    $this->assertNull($table->caption());
    $tbody = new Tbody();
    $this->assertSame($table, $table->setTbody($tbody));
    $this->assertSame($tbody, $table->tbody());
    $this->assertSame($table, $table->setTbody(null));
    $this->assertNull($table->tbody());
    $this->assertSame($table, $table->useTbody());
    $this->assertInstanceOf(Tbody::class, $table->tbody());
    $this->assertSame($table, $table->useTbody(false));
    $this->assertNull($table->tbody());
  }

  public function testTbodyMethods() {
    $table = $this->createEmptyTable();
    $this->assertNull($table->tbody());
    $tbody = new Tbody();
    $this->assertSame($table, $table->setTbody($tbody));
    $this->assertSame($tbody, $table->tbody());
    $this->assertSame($table, $table->setTbody(null));
    $this->assertNull($table->tbody());
    $this->assertSame($table, $table->useTbody());
    $this->assertInstanceOf(Tbody::class, $table->tbody());
    $this->assertSame($table, $table->useTbody(false));
    $this->assertNull($table->tbody());
  }

  public function testTfootMethods() {
    $table = $this->createEmptyTable();
    $this->assertNull($table->tfoot());
    $tfoot = new Tfoot();
    $this->assertSame($table, $table->setTfoot($tfoot));
    $this->assertSame($tfoot, $table->tfoot());
    $this->assertSame($table, $table->setTfoot(null));
    $this->assertNull($table->tfoot());
    $this->assertSame($table, $table->useTfoot());
    $this->assertInstanceOf(Tfoot::class, $table->tfoot());
    $this->assertSame($table, $table->useTfoot(false));
    $this->assertNull($table->tfoot());
  }

  public function testCount() {
    $table = $this->createEmptyTable();
    $body = new Tbody();
    $body->appendBodyRow(range(1, 3));
    $this->assertCount(0, $table);
    $table->useTbody()->useTfoot()->useThead();
    $this->assertCount(0, $table);
    $table->setContent($body);
    $this->assertCount(1, $table);
  }

  public function testClone() {
    $table = $this->createEmptyTable();
    $table->setCaption('foo')->useTbody()->useTfoot()->useThead();
    $caption = $table->caption();
    $head = $table->thead();
    $head->appendHeaderRow(range(1, 3));
    $body = $table->tbody();
    $body->appendHeaderRow(range(1, 3));
    $body->appendBodyRow(range(1, 3));
    $foot = $table->tfoot();
    $foot->appendBodyRow(range(1, 3));
    $foot->appendHeaderRow(range(1, 3));
    $cloned = clone $table;
    $this->assertNotSame($table, $cloned);
    $this->assertNotSame($caption, $cloned->caption());
    $this->assertNotSame($body, $cloned->tbody());
    $this->assertNotSame($head, $cloned->thead());
    $this->assertNotSame($foot, $cloned->tfoot());
  }

  public function testIterator() {
    $table = $this->createEmptyTable();
    $this->assertCount(0, $table->getIterator());
    $table->setCaption('foo')->useThead()->useTbody()->useTfoot();
    $this->assertCount(4, $table->getIterator());
    foreach ($table as $key => $component) {
      $this->assertEquals($component->getTagName(), $key);
      $this->assertInstanceOf(TableContent::class, $component);
    }
  }

}
