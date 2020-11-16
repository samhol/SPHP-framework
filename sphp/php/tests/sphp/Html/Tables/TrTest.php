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
use Sphp\Html\Tables\Tr;
use Sphp\Html\Tables\Td;
use Sphp\Html\Tables\Th;

class TrTest extends TestCase {

  /**
   * @return array
   */
  public function cells(): array {
    return [
        ['string'],
        [''],
        [0],
    ];
  }

  /**
   * @dataProvider cells
   * 
   * @param mixed $data
   */
  public function testAppendTd($data) {
    $tr = new Tr();
    $obj = $tr->appendTd($data);
    $this->assertInstanceOf(Td::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @return void
   */
  public function testAppendTds(): void {
    $data = range('a', 'e');
    $tr = new Tr();
    $tr2 = new Tr();
    $tr3 = Tr::fromTds($data);
    $this->assertSame($tr, $tr->appendTds($data));
    foreach ($data as $index => $value) {
      $cells[$index] = $tr2->appendTd($value);
      $this->assertEquals($cells[$index], $tr->getCell($index));
      $this->assertEquals($cells[$index], $tr3->getCell($index));
    }
    $this->assertSame(implode('', $cells), $tr->contentToString());
  }

  /**
   * @param mixed $data
   */
  public function testAppendThs() {
    $data = range('a', 'e');
    $tr = new Tr();
    $tr2 = new Tr();
    $tr3 = Tr::fromThs($data);
    $this->assertSame($tr, $tr->appendThs($data));
    foreach ($data as $index => $value) {
      $cells[$index] = $tr2->appendTh($value);
      $this->assertEquals($cells[$index], $tr->getCell($index));
      $this->assertEquals($cells[$index], $tr3->getCell($index));
    }
    $this->assertSame(implode('', $cells), $tr->contentToString());
  }

  /**
   * @dataProvider cells
   * 
   * @param mixed $data
   */
  public function testAppendTh($data) {
    $tr = new Tr();
    $obj = $tr->appendTh($data);
    $this->assertInstanceOf(Th::class, $obj);
    $this->assertSame($data, $obj->offsetGet(0));
  }

  /**
   * @dataProvider cells
   * 
   * @param mixed $data
   */
  public function testPrepend($data) {
    $tr = new Tr();
    $td = $tr->prepend(new Td($data));
    $this->assertSame($data, $td->offsetGet(0));
    $th = $tr->prepend(new Th($data));
    $this->assertInstanceOf(Th::class, $th);
    $this->assertSame($data, $th->offsetGet(0));
  }

  public function testIteratorAndCounting() {
    $tr = new Tr();
    $this->assertNull($tr->getCell(0));
    $tr->appendThs(range(1, 4));
    $this->assertNull($tr->getCell(4));
    $this->assertCount(4, $tr);
    foreach ($tr as $key => $th) {
      $this->assertInstanceOf(Th::class, $th);
      $val = (1 + $key);
      $this->assertSame("<th>$val</th>", (string) $tr->getCell($key));
      $this->assertSame("<th>$val</th>", (string) $th);
    }
  }

}
