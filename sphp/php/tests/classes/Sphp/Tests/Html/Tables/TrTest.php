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

  public function testAppendTd() {
    $tr = new Tr();
    $td1 = $tr->appendTd('foo');
    $this->assertInstanceOf(Td::class, $td1);
    $this->assertSame('foo', $td1->getContent()[0]);
    $this->assertSame($td1, $tr[0]);
  }

  /**
   * @return void
   */
  public function testAppendTds(): void {
    $data = range('a', 'e');
    $tr = new Tr();
    $tr2 = new Tr();
    $tr3 = Tr::fromTds($data);
    $this->assertSame($tr, $tr->appendTds(...$data));
    foreach ($data as $index => $value) {
      $cells[$index] = $tr2->appendTd($value);
      $this->assertEquals($cells[$index], $tr[$index]);
      $this->assertEquals($cells[$index], $tr3[$index]);
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
    $this->assertSame($tr, $tr->appendThs(...$data));
    foreach ($data as $index => $value) {
      $cells[$index] = $tr2->appendTh($value);
      $this->assertEquals($cells[$index], $tr[$index]);
      $this->assertEquals($cells[$index], $tr3[$index]);
    }
    $this->assertSame(implode('', $cells), $tr->contentToString());
  }

  public function testAppendTh(): void {
    $tr = new Tr();
    $cell = $tr->appendTh('foo');
    $this->assertInstanceOf(Th::class, $cell);
    $this->assertSame($tr[0], $cell);
  }

  public function testPrepend(): void {
    $tr = new Tr();
    $this->assertSame($tr, $tr->prepend($td1 = new Td('foo')));
    $this->assertSame($td1, $tr[0]);
    $tr->prepend($td2 = new Td('bar'));
    $this->assertSame($td2, $tr[0]);
    $this->assertSame($td1, $tr[1]);

    $tr->prepend($th = new Th('baz'));
    $this->assertSame($th, $tr[0]);
    $this->assertSame($td2, $tr[1]);
    $this->assertSame($td1, $tr[2]);
  }

  public function testIteratorAndCounting() {
    $tr = new Tr();
    $this->assertNull($tr[0]);
    $data = range(1, 4);
    $tr->appendThs(...$data);
    $this->assertNull($tr[4]);
    $this->assertCount(4, $tr);
    foreach ($tr as $key => $th) {
      $this->assertInstanceOf(Th::class, $th);
      $val = (1 + $key);
      $this->assertSame("<th>$val</th>", (string) $tr[$key]);
      $this->assertSame("<th>$val</th>", (string) $th);
    }
  }

}
