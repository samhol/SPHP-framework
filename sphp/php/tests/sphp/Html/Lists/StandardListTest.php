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

use PHPUnit\Framework\TestCase;
use Sphp\Html\Lists\StandardList;
use Sphp\Html\Lists\StandardListItem;
use Sphp\Html\Lists\Li;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;
use Sphp\Html\Span;
use Sphp\Html\Navigation\A;

class StandardListTest extends TestCase {

  public function createList(iterable $value = null): StandardList {
    return $this->getMockForAbstractClass(StandardList::class, ['list', $value]);
  }

  public function testConstructorParams(): void {
    $list = $this->createList($li = new Li(range(1, 2)));
    $this->assertCount(1, $list);
    $this->assertContains($li, $list);
  }

  /**
   * @return array
   */
  public function items(): array {
    $items = [];
    $items[] = \Sphp\Html\Tags::span('foo');
    $items[] = \Sphp\Html\Tags::li('foo');
    $items[] = 'foo';
    return $items;
  }

  public function testClone(): void {
    $list = $this->createList(range(1, 3));
    $clone = clone $list;
    $this->assertNotSame($list, $clone);
    $this->assertSame($list->getHtml(), $clone->getHtml());
  }

  /**
   * @return void
   */
  public function testAppend(): void {
    $list = $this->createList();
    $cont = '';
    $items = $this->items();
    foreach ($items as $value) {
      $obj = $list->append($value);
      if ($value instanceof StandardListItem) {
        $this->assertSame($value, $obj);
      } else {
        $this->assertSame("<li>$value</li>", (string) $obj);
      }
      $cont .= $obj;
    }
    $this->assertSame($cont, $list->contentToString());
    $this->assertCount(count($items), $list);
  }

  /**
   * @return void
   */
  public function testPrepend(): void {
    $list = $this->createList();
    $cont = '';
    $items = $this->items();
    foreach ($items as $value) {
      $obj = $list->prepend($value);
      if ($value instanceof StandardListItem) {
        $this->assertSame($value, $obj);
      } else {
        $this->assertSame("<li>$value</li>", (string) $obj);
      }
      $cont = $obj . $cont;
    }
    $this->assertSame($cont, $list->contentToString());
    $this->assertCount(count($items), $list);
  }

  public function testClear(): void {
    $items = $this->items();
    $list = $this->createList($items);
    $this->assertCount(count($items), $list);
    $this->assertSame($list, $list->clear());
    $this->assertCount(0, $list);
  }

  public function testAppendMarkdown(): void {
    $list1 = $this->createList();
    $list2 = $this->createList();
    $mdString = \Sphp\Stdlib\Filesystem::toString('./sphp/php/tests/files/valid.md');
    $mdToHtml = ParseFactory::md()->parseFile('./sphp/php/tests/files/valid.md');
    $li1 = $list1->appendMarkdown($mdString);
    $li2 = $list2->appendMarkdownFile('./sphp/php/tests/files/valid.md');
    $this->assertSame($mdToHtml, $li1->contentToString());
    $this->assertSame($mdToHtml, $li2->contentToString());
    $this->expectException(HtmlException::class);
    $list1->appendMarkdownFile('foo.md');
  }

  /**
   * @return array
   */
  public function linkData(): array {
    $items = [];
    $items[] = ['/foo'];
    $items[] = ['/foo', 'bar'];
    $items[] = ['/foo', 'bar', '_self'];
    $items[] = ['/foo', new Span('foo'), '_self'];
    return $items;
  }

  /**
   * @dataProvider linkData
   * 
   * @param  string $href
   * @param  mixed $content
   * @param  string $target
   * @return void
   */
  public function testAppendLink(string $href, $content = null, string $target = null): void {
    $list = $this->createList();
    $a = new A($href, $content, $target);
    $li = $list->appendLink($href, $content, $target);
    $this->assertContains($li, $list);
    $this->assertEquals($a, $li->getHyperlink());
  }

}
