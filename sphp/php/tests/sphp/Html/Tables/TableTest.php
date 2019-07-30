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

class TableTest extends TestCase {

  /**
   * @var Table
   */
  protected $table;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->table = new Table();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->table);
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
   */
  public function testSetContent() {
    $this->assertSame("$this->table", '<table></table>');
    $caption = new Caption('caption');
    $this->table->setContent($caption);
    $this->assertSame("$this->table", "<table>$caption</table>");
    $thead = new Thead();
    $thead->appendHeaderRow(['a']);
    $this->table->setContent($thead);
    $this->assertSame("$this->table", "<table>{$caption}{$thead}</table>");
    $tbody = new Tbody();
    $tbody->appendBodyRow(['b']);
    $this->table->setContent($tbody);
    $this->assertCount(2, $this->table);
    $tfoot = new Tfoot();
    $tfoot->appendBodyRow(['c']);
    $this->table->setContent($tfoot);
    $this->assertCount(3, $this->table);
    $this->assertSame("$this->table", "<table>{$caption}{$thead}{$tbody}{$tfoot}</table>");
  }

  public function testTheadMethods() {
    $this->assertNull($this->table->thead());
    $thead = new Thead();
    $this->assertSame($this->table, $this->table->setThead($thead));
    $this->assertSame($thead, $this->table->thead());
    $this->assertSame($this->table, $this->table->setThead(null));
    $this->assertNull($this->table->thead());
    $this->assertSame($this->table, $this->table->useThead());
    $this->assertInstanceOf(Thead::class, $this->table->thead());
    $this->assertSame($this->table, $this->table->useThead(false));
    $this->assertNull($this->table->thead());
  }

  public function testCaptionMethods() {
    $this->assertNull($this->table->caption());
    $tbody = new Tbody();
    $this->assertSame($this->table, $this->table->setTbody($tbody));
    $this->assertSame($tbody, $this->table->tbody());
    $this->assertSame($this->table, $this->table->setTbody(null));
    $this->assertNull($this->table->tbody());
    $this->assertSame($this->table, $this->table->useTbody());
    $this->assertInstanceOf(Tbody::class, $this->table->tbody());
    $this->assertSame($this->table, $this->table->useTbody(false));
    $this->assertNull($this->table->tbody());
  }

  public function testTbodyMethods() {
    $this->assertNull($this->table->tbody());
    $tbody = new Tbody();
    $this->assertSame($this->table, $this->table->setTbody($tbody));
    $this->assertSame($tbody, $this->table->tbody());
    $this->assertSame($this->table, $this->table->setTbody(null));
    $this->assertNull($this->table->tbody());
    $this->assertSame($this->table, $this->table->useTbody());
    $this->assertInstanceOf(Tbody::class, $this->table->tbody());
    $this->assertSame($this->table, $this->table->useTbody(false));
    $this->assertNull($this->table->tbody());
  }

  public function testTfootMethods() {
    $this->assertNull($this->table->tfoot());
    $tfoot = new Tfoot();
    $this->assertSame($this->table, $this->table->setTfoot($tfoot));
    $this->assertSame($tfoot, $this->table->tfoot());
    $this->assertSame($this->table, $this->table->setTfoot(null));
    $this->assertNull($this->table->tfoot());
    $this->assertSame($this->table, $this->table->useTfoot());
    $this->assertInstanceOf(Tfoot::class, $this->table->tfoot());
    $this->assertSame($this->table, $this->table->useTfoot(false));
    $this->assertNull($this->table->tfoot());
  }

  public function testCount() {
    $table = new Table();
    $body = new Tbody();
    $body->appendBodyRow(range(1, 3));
    $this->assertCount(0, $table);
    $table->useTbody()->useTfoot()->useThead();
    $this->assertCount(0, $table);
    $table->setContent($body);
    $this->assertCount(1, $table);
  }

  public function testClone() {
    $table = new Table();
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
    $this->assertNotSame($caption,$cloned->caption());
    $this->assertNotSame($body, $cloned->tbody());
    $this->assertNotSame($head, $cloned->thead());
    $this->assertNotSame($foot, $cloned->tfoot());
  }

  public function testIterator() {
    $table = new Table();
    $this->assertCount(0, $table->getIterator());
    $table->setCaption('foo')->useThead()->useTbody()->useTfoot();
    $this->assertCount(4, $table->getIterator());
    foreach ($table as $key => $component) {
      $this->assertEquals($component->getTagName(), $key);
      $this->assertInstanceOf(TableContent::class, $component);
    }
  }

}
