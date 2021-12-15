<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2021 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Bootstrap\Layout;

use PHPUnit\Framework\TestCase;
use Sphp\Bootstrap\Layout\Row;
use Sphp\Bootstrap\Layout\Col;
use Sphp\Bootstrap\Exceptions\BootstrapException;

/**
 * Class GutterManagerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class RowTest extends TestCase {

  /**
   * @return void
   */
  public function testConstructor(): void {
    $row = new Row();
    $this->assertCount(0, $row);
    $this->assertTrue($row->hasCssClass('row'));
    $this->assertCount(1, $row->cssClasses());
  }

  /**
   * @return void
   */
  public function testResetGutter(): void {
    $row = new Row();
    $this->assertSame($row, $row->setGutters('g-1'));
    $this->assertTrue($row->hasCssClass('g-1'));
    $this->assertSame($row, $row->setGutters('g-2'));
    $this->assertTrue($row->hasCssClass('g-2'));
    $this->assertFalse($row->hasCssClass('g-1'));
  }

  /**
   * @return <int, <int, string>>
   */
  public function setGutterData(): array {
    $data[] = [['g-1', 'g-2'], ['g-2']];
    $data[] = [['gx-1'], ['gx-1']];
    $data[] = [['gx-1', 'g-2'], ['gx-1', 'g-2']];
    $data[] = [['gx-lg-1', 'gx-sm-2'], ['gx-lg-1', 'gx-sm-2']];
    $data[] = [['gx-lg-1', 'gx-lg-2'], ['gx-lg-2']];
    return $data;
  }

  /**
   * @dataProvider setGutterData
   *  
   * @param  string[] $value
   * @param  string[] $expectedClassName
   * @return void
   */
  public function testSetGutter(array $value, array $expectedClassName): void {
    $row = new Row();
    $this->assertSame($row, $row->setGutters(...$value));
    $this->assertTrue($row->hasCssClass(...$expectedClassName));
  }

  /**
   * @return array<int, string>
   */
  public function setInvalidGutterData(): array {
    $ints[] = ['g-6'];
    $ints[] = ['gx-sm-6'];
    $ints[] = ['gx-sm'];
    $ints[] = ['xy-1'];
    $ints[] = ['g-1-1'];
    $ints[] = ['g'];
    return $ints;
  }

  /**
   * @dataProvider setInvalidGutterData
   *
   * @param  string $value
   * @return void
   */
  public function testSetInvalidGutters(string $value): void {
    $row = new Row();
    $this->expectException(BootstrapException::class);
    $row->setGutters($value);
  }

  /**
   * @return array<int, string>
   */
  public function guttersData(): array {
    $ints[] = ['g-0', 'g-md-1', 'gx-lg-3', 'gx-3'];
    return $ints;
  }

  public function gutterSets(): array {
    $sets[] = ['g-0', 'g-sm-1', 'gx-md-3', 'gy-md-5'];
    return $sets;
  }

  /**
   * @return void
   */
  public function testUnsetGutters(): void {
    $row = new Row();
    $row->setGutters('gx-1', 'gy-1');
    $row->unsetGutters('gx-1');
    $this->assertFalse($row->hasCssClass('gx-1'));
    $this->assertTrue($row->hasCssClass('gy-1'));
    $this->expectException(BootstrapException::class);
    $row->unsetGutters('f');
  }

  /**
   * @dataProvider gutterSets
   * 
   * @param  string ...$value
   * @return void
   */
  public function testRemoveAllGutters(string ...$value): void {
    $row = new Row();
    $row->setGutters(...$value);
    $this->assertSame($row, $row->unsetGutters());
    $this->assertTrue(1 === $row->cssClasses()->count());
  }

  public function testClone(): void {
    $row = new Row();
    $clone = clone $row;
    $this->assertEquals($row, $clone);
    $this->assertNotSame($row, $clone);
    $row->md(3);
    $this->assertNotEquals((string) $row, (string) $clone);
    $clone->md(3);
    $this->assertEquals((string) $row, (string) $clone);
    $row->appendColumn('foo');
    $this->assertNotEquals((string) $row, (string) $clone);
    $clone->appendColumn('foo');
    $this->assertEquals((string) $row, (string) $clone);
  }

  public function testAppendColumn(): void {
    $row = new Row();
    $col1 = $row->appendColumn('foo');
    $col2 = Col::create('foo');
    $this->assertSame($col2, $row->appendColumn($col2));
    $this->assertEquals((string) $col1, (string) $col2);
  }

  public function testRowCols(): void {
    $row = new Row();
    $row->sm(1);
    $this->assertTrue($row->hasCssClass('row row-cols-sm-1'));
    $this->assertTrue(2 === $row->cssClasses()->count());
    $row->sm(2);
    $this->assertTrue($row->hasCssClass('row row-cols-sm-2'));
    $this->assertTrue(2 === $row->cssClasses()->count());
    $this->assertFalse($row->hasCssClass('row-cols-sm-1'));
    $row->default(2);
    $this->assertTrue($row->hasCssClass('row row-cols-2 row-cols-sm-2'));
    $this->assertCount(3, $row->cssClasses());
  }

}
