<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
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
use Sphp\Html\Lists\HyperlinkListItem;

class StandardListTest extends TestCase {

  public function createList(): StandardList {
    return $this->getMockForAbstractClass(StandardList::class, ['list']);
  }

  public function testConstructor(): void {
    $list = $this->createList();
    $this->assertNull($list->getItem(0));
  }

  /**
   * @return array
   */
  public function items(): iterable {
    $items = [];
    $items[] = \Sphp\Html\Tags::span('foo');
    $items[] = \Sphp\Html\Tags::li('foo');
    $items[] = 'foo';
    return $items;
  }

  public function testClone(): void {
    $list = $this->createList();
    $item = $list->append('foo');
    $clone = clone $list;
    $this->assertNotSame($list, $clone);
    $this->assertEquals($item, $clone->getItem(0));
    $this->assertNotSame($item, $clone->getItem(0));
    $this->assertSame($list->getHtml(), $clone->getHtml());
  }

  /**
   * @return StandardList
   */
  public function testAppendAndPrepend(): StandardList {
    $list = $this->createList();
    $cont = '';
    $items = [];

    $obj = $list->append('foo');
    $this->assertInstanceOf(Li::class, $obj);
    $this->assertSame("<li>foo</li>", (string) $obj);
    $this->assertSame($obj, $list->getItem(0));
    $cont .= $obj;
    $items[] = $obj;
    $li = $list->append($inserted = new Li('bar'));
    $this->assertSame($li, $inserted);
    $this->assertSame($li, $list->getItem(1));
    $cont .= $li;
    $items[] = $li;
    $hyperLink = new HyperlinkListItem();
    $this->assertSame($hyperLink, $list->append($hyperLink));
    $cont .= $hyperLink;
    $items[] = $hyperLink;
    $this->assertSame($cont, $list->contentToString());
    $this->assertCount(count($items), $list);
    return $list;
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

  /**
   * @depends testAppendAndPrepend
   * 
   * @param StandardList $list
   * @return void
   */
  public function testClear(StandardList $list): void {
    $this->assertNotEmpty($list);
    $this->assertSame($list, $list->clear());
    $this->assertEmpty($list);
    $this->assertCount(0, $list);
    $this->assertSame('', $list->contentToString());
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
