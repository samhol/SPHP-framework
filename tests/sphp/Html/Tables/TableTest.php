<?php

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
  public function testParts() {
    $this->assertSame("$this->table", '<table></table>');
    $caption = $this->table->setCaption('caption');

    $this->assertInstanceOf(Caption::class, $caption);
    $this->assertSame("$this->table", '<table><caption>caption</caption></table>');
    $this->table->thead()->appendHeaderRow(range('a', 'b'));
    $this->assertSame("$this->table", '<table><caption>caption</caption><thead><tr><th>a</th><th>b</th></tr></thead></table>');
    $this->table->tfoot()->appendBodyRow(range('c', 'd'));
    $this->table->tbody()->appendBodyRow(range(1, 2));
    $this->assertEquals($this->table->count(), 3);
    $this->assertSame("$this->table", '<table><caption>caption</caption><thead><tr><th>a</th><th>b</th></tr></thead><tfoot><tr><td>c</td><td>d</td></tr></tfoot><tbody><tr><td>1</td><td>2</td></tr></tbody></table>');
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function tesstPrepend($val) {
    $this->table->append("foo");
    $this->table->prepend($val);
    $this->assertTrue($this->table->groupExists(0));
    $this->assertTrue($this->table->groupExists(1));
    $this->assertEquals($this->table->count(), 2);
    $this->assertEquals($this->table[0], $val);
  }

  /**
   * 
   * @dataProvider appendData
   * @param mixed $val
   */
  public function tesstOffsetSet($val) {
    $this->container->append("foo");
    $this->container[] = $val;
    $this->container["a"] = $val;
    $this->assertTrue($this->container->groupExists(0));
    $this->assertTrue($this->container->groupExists(1));
    $this->assertTrue($this->container->groupExists("a"));
    $this->assertEquals($this->container->count(), 3);
    $this->assertEquals($this->container[1], $val);
    $this->assertEquals($this->container["a"], $val);
  }

}
