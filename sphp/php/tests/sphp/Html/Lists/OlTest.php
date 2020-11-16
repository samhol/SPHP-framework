<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Lists;

use Sphp\Html\Lists\Ol;
use Sphp\Html\Lists\StandardList;

class OlTest extends StandardListTest {

  /**
   * @return array
   */
  public function types(): array {
    return [
        ['1'],
        ['a'],
        ['A'],
        ['i'],
        ['I'],
    ];
  }

  /**
   * @dataProvider types
   * 
   * @param mixed $data
   */
  public function testListType(string $data) {
    $list = new Ol();
    $this->assertSame(null, $list->getAttribute('type'));
    $this->assertSame('1', $list->getListType());
    $list->setListType($data);
    $this->assertSame($data, $list->getAttribute('type'));
    $this->assertSame($data, $list->getListType());
  }

  public function testStart() {
    $list = new Ol();
    $this->assertSame(1, $list->getStart());
    $list->setStart(10);
    $this->assertSame(10, $list->getStart());
  }

  public function testReversed() {
    $list = new Ol();
    $this->assertFalse($list->attributeExists('reversed'));
    $this->assertSame($list, $list->setReversed(true));
    $this->assertSame(true, $list->getAttribute('reversed'));
    $this->assertTrue($list->attributeExists('reversed'));
    $this->assertSame($list, $list->setReversed(false));
    $this->assertFalse($list->attributeExists('reversed'));
  }

  public function createList(iterable $value = null): StandardList {
    return new Ol($value);
  }

}
