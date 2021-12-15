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
use Sphp\Bootstrap\Layout\Col;
use Sphp\Bootstrap\Exceptions\BootstrapException;

/**
 * The ColumnTest class
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class ColTest extends TestCase {

  public function testConstructor() {
    $column = new Col();
    $this->assertTrue($column->hasCssClass('col'));
  }

  /**
   * @return array<int, string>
   */
  public function unsetWidthsData(): array {
    $ints[] = ['sm', null];
    $ints[] = ['lg', 'xxl'];
    $ints[] = ['md', 'xxl'];
    $ints[] = ['xl', 'xxl', 'lg'];
    $ints[] = ['xxl', 'md'];
    return $ints;
  }

  /**
   * @dataProvider unsetWidthsData
   *  
   * @param  string|null ... $breakpoint
   * @return void
   */
  public function testUnsetWidths(?string ... $breakpoint): void {
    $col = new Col();
    $regex = "/^((" . implode('|', $breakpoint) . ")(-([1-9]|(1[0-2])|auto)))$/";
    $col->setLayouts(1, 'sm-1', 'md-auto', 'lg-12', 'xl-12', 'xxl-1');
    $this->assertSame($col, $col->unsetBreakpoints(...$breakpoint));
    $this->assertFalse($col->cssClasses()->contaisPattern($regex));
    $this->expectException(BootstrapException::class);
    $col->unsetBreakpoints('col-lg', 'foo');
  }

  public function testClone(): void {
    $col = new Col();
    $clone = clone $col;
    $this->assertEquals($col, $clone);
    $this->assertNotSame($col, $clone);
    $col->md(3);
    $this->assertNotEquals($col, $clone);
    $clone->md(3);
    $this->assertEquals($col, $clone);
    $col->append('foo');
    $this->assertNotEquals($col, $clone);
    $clone->append('foo');
    $this->assertEquals($col, $clone);
  }

}
