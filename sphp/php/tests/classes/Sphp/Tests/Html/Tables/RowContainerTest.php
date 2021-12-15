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
use Sphp\Html\Tables\RowContainer;
use Sphp\Html\Tables\TableContent;
use Sphp\Html\Tables\Tr;

class RowContainerTest extends TestCase {

  public function testConstructor(): RowContainer {
    $rows = $this->getMockForAbstractClass(RowContainer::class, ['tbody']);
    $this->assertInstanceOf(TableContent::class, $rows);
    $this->assertCount(0, $rows);
    $this->assertNull($rows[0]);
    $this->assertSame("<tbody></tbody>", (string) $rows);
    return $rows;
  }

  /**
   * @depends testConstructor
   * 
   * @param RowContainer $rows
   */
  public function testArrayAccessAndTraversing(RowContainer $rows) {
    $data = [
        'foo' => 'bar',
        'tr' => Tr::fromTds([1, 2, 3]),
    ];
    $data[] = 'appended';
    $sequential = $this->getMockForAbstractClass(RowContainer::class, ['tbody']);
    $seq = 0;
    foreach ($data as $key => $value) {
      $sequential[] = $value;
      //var_dump($sequential);
      $rows[$key] = $value;
      $this->assertInstanceOf(\Sphp\Html\Tables\Row::class, $rows[$key]);
      $this->assertEquals($sequential[$seq], $rows[$key]);
      $seq++;
    }
  }

  /**
   * @depends testConstructor
   * 
   * @param RowContainer $rows
   */
  public function testAppendAndPrepend(RowContainer $rows) {
    $appended = Tr::fromTds(range('a', 'c'));
    $rows->append($appended);
    $this->assertCount(4, $rows);
    $this->assertSame($appended, $rows[1]);
    $prepended = Tr::fromTds(range('a', 'c'));
    $rows->prepend($prepended);
    $this->assertCount(5, $rows);
    $this->assertSame($prepended, $rows[0]);
    $this->assertSame($appended, $rows[2]);
  }

}
