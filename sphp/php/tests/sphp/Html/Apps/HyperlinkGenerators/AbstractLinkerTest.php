<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Apps\HyperlinkGenerators;

use PHPUnit\Framework\TestCase;

/**
 * Description of AbstractClassLinkerTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractLinkerTest extends TestCase {

  /**
   * @param  BasicUrlGenerator $urlGen
   * @return AbstractLinker
   */
  public function createLinker(BasicUrlGenerator $urlGen = null): AbstractLinker {
    if ($urlGen === null) {
      $urlGen = new BasicUrlGenerator();
    }
    $linker = $this->getMockForAbstractClass(AbstractLinker::class, [$urlGen]);
    return $linker;
  }

  public function hyperlinkParams(): array {
    $params = [];
    $params[] = ['/foo', null, 'content', 'bar', 'content'];
    $params[] = ['/foo', null, 'content', null, 'content'];
    $params[] = ['/foo', null, null, null, '/foo'];
    $params[] = [null, null, null, null, null];
    return $params;
  }

  /**
   * @dataProvider hyperlinkParams
   * @param string $url
   * @param string $content
   * @param string $title
   */
  public function test1(string $root = null, string $url = null, string $content = null, string $title = null, string $expectedContent = null) {
    $urlGen = new BasicUrlGenerator($root);
    $linker = $this->createLinker($urlGen);
    $this->assertSame($urlGen, $linker->urls());
    $a = $linker->hyperlink($url, $content, $title);
    $this->assertSame((string) $expectedContent, $a->contentToString());
    //$this->assertEquals($linker($url, $content, $title), $a);
    $this->assertSame($title, $a->getAttribute('title'));
    $this->assertSame("$root$url", (string) $a->getHref());
  }

  public function defaultAttributes(): array {
    $attrs = [];
    $attrs[] = [['class' => 'a b', 'data-foo' => true]];
    return $attrs;
  }

  /**
   *
   * @dataProvider defaultAttributes
   * @param array $attrs
   */
  public function testDefaultAttributes(array $attrs) {
    $urlGen = new BasicUrlGenerator('/foo');
    $linker = $this->createLinker($urlGen);
    $this->assertEmpty($linker->getAttributes());
    $this->assertSame($linker, $linker->useAttributes($attrs));
    $this->assertSame($attrs, $linker->getAttributes($attrs));
    $link = $linker->hyperlink('bar', 'content');
    foreach ($attrs as $name => $value) {
      $this->assertTrue($link->attributeExists($name));
    }
  }

  public function testClone() {
    $urlGen = new BasicUrlGenerator('/foo');
    $linker = $this->createLinker($urlGen);
    $linker->useAttributes(['data-foo' => 'bar']);
    $clone = clone $linker;
    $this->assertNotSame($linker, $clone);
    $this->assertNotSame($linker->urls(), $clone->urls());
  }

  public function testToString() {
    $urlGen = new BasicUrlGenerator('/');
    $linker = $this->createLinker($urlGen);
    $this->assertSame((string) $linker->hyperlink(), (string) $linker);
  }

}
