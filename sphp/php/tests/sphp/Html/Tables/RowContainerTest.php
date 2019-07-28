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

class RowContainerTest extends TestCase {

  public function testConstructor(): RowContainer {
    $rows = $this->getMockForAbstractClass(RowContainer::class, ['tbody']);
    $this->assertInstanceOf(TableContent::class, $rows);
    $this->assertCount(0, $rows);
    $this->assertNull($rows->getRow(-1));
    $this->assertNull($rows->getRow(0));
    $this->assertNull($rows->getRow(1));
    return $rows;
  }
  /**
   * @depends testConstructor
   * 
   * @param RowContainer $rows
   */
  public function testAppendAndPrepend(RowContainer $rows) {
    $appended = Tr::fromTds(range('a', 'c'));
    $rows->append($appended);
    $this->assertCount(1, $rows);
    $this->assertSame($appended, $rows->getRow(0));
    $prepended = Tr::fromTds(range('a', 'c'));
    $rows->prepend($prepended);
    $this->assertCount(2, $rows);
    $this->assertSame($prepended, $rows->getRow(0));
    $this->assertSame($appended, $rows->getRow(1));
    
  }

}
