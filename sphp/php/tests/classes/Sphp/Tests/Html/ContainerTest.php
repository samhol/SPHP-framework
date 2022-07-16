<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Container;
use Sphp\Html\PlainContainer;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;
use Sphp\Stdlib\Filesystem;
use Sphp\Html\Text\Span;
use Sphp\Html\Layout\Div;

class ContainerTest extends TestCase {

  use TraversableContentTestTrait,
      \Sphp\Tests\ArrayAccessTestTrait;

  private PlainContainer $container;

  public function createContainer(): PlainContainer {
    return new PlainContainer();
  }

  public function createArrayAccessObject(): PlainContainer {
    return $this->createContainer();
  }

  public function arrayAccessTestData(): array {
    return $this->traversableContent();
  }

  public function create(iterable $content): \Sphp\Html\TraversableContent {
    $container = new PlainContainer();
    foreach ($content as $key => $val) {
      $container[$key] = $val;
    }
    return $container;
  }

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->container = $this->createContainer();
  }

  /**
   * Tears down the fixture, for example, closes a network connection.
   * This method is called after a test is executed.
   */
  protected function tearDown(): void {
    unset($this->container);
    parent::tearDown();
  }

  public function testInserting(): Container {
    $c = new PlainContainer();
    $c->append('b');
    $c->append('c');
    $c->prepend('a');
    $this->assertTrue($c->contains('a'));
    $this->assertTrue($c->contains('b'));
    $this->assertTrue($c->contains('c'));
    $this->assertFalse($c->contains('d'));
    $c->resetContent('foobar');
    $this->assertFalse($c->contains('a'));
    $this->assertTrue($c->contains('foobar'));
    return $c;
  }

  /**
   * @depends testInserting
   * 
   * @param Container $c
   */
  public function testCountable(Container $c): void {
    $c->clear();
    $this->assertCount(0, $c);
    $c->append('b', 'c', 'd');
    $array = $c->toArray();
    $this->assertCount(count($array), $c);
  }

  public function testGetHtml(): void {
    $c = new PlainContainer();
    $this->assertSame('', $c->getHtml());
    $c->append('b');
    $c->append('c');
    $c->append('d');
    $c->prepend('a');
    $this->assertSame('abcd', $c->getHtml());
    $c2 = new PlainContainer();
    $c->append($c2);
    $this->assertSame('abcd', $c->getHtml());
    $c2->append(' is foo');
    $c->append([' and ', 'bar', ['!']]);
    $this->assertSame('abcd is foo and bar!', $c->getHtml());
    $this->expectException(\Exception::class);
    $c->append(new \ArrayObject([' Shell', ' is', ' not!']));
    $this->assertSame('abc is foo and bar! Shell is not!', $c->getHtml());
    $c->append(new \stdClass());
    //var_dump($c);
    $c->getHtml();
  }

  public function testToArray(): void {
    $container = new PlainContainer();
    $this->assertEquals([], $container->toArray());
    $container->append('b');
    $container->append('c');
    $container->append('d');
    $container->prepend('a');
    $this->assertCount(4, $container);
    $this->assertEquals(range('a', 'd'), $container->toArray());
  }

  public function testArrayAccess(): void {
    $container = new PlainContainer();
    $this->assertNull($container[0]);
    $this->assertFalse(isset($container[0]));
    $container[] = 'foo';
    $this->assertSame('foo', $container[0]);
    $container[0] = 'bar';
    $this->assertSame('bar', $container[0]);
    $this->assertFalse(isset($container['foo']));
    $container['foo'] = 'foobar';
    $this->assertTrue(isset($container['foo']));
    $this->assertSame('foobar', $container['foo']);
    $container[] = 'baz';
    $this->assertTrue(isset($container[1]));
    $this->assertSame('baz', $container[1]);
    unset($container[0]);
    $this->assertFalse(isset($container[0]));
  }

  public function contentData(): iterable {
    yield [null];
    yield ['a'];
    yield [new PlainContainer('bar')];
    yield [0];
  }

  /**
   * @dataProvider contentData
   * 
   * @param  mixed $val
   * @return void
   */
  public function testAppendVsArrayAccess($val): void {
    $container = new PlainContainer();
    $container->append('foo');
    $this->assertSame($container[0], 'foo');
    $this->assertTrue($container->offsetExists(0));
    $this->assertFalse($container->offsetExists(1));
    $container->append($val);
    $this->assertTrue($container->offsetExists(1));
    $this->assertEquals($container->count(), 2);
    $this->assertEquals($container[1], $val);
  }

  /**
   * @return void
   */
  public function testAppendSpecificTags(): void {
    $container = new PlainContainer();
    $hyperlink = $container->appendHyperlink('href', 'bar', 'baz');
    $this->assertSame('bar', $hyperlink->contentToString());
    $this->assertSame('href', $hyperlink->getHref());
    $this->assertSame('baz', $hyperlink->getTarget());
    $this->assertCount(1, $container);
    $this->assertSame($hyperlink, $container[0]);
  }

  /**
   * @dataProvider contentData
   * 
   * @param mixed $val
   * @return void
   */
  public function testPrepend(mixed $val): void {
    $this->container->append('foo');
    $this->container->prepend($val);
    $this->assertTrue($this->container->offsetExists(0));
    $this->assertTrue($this->container->offsetExists(1));
    $this->assertEquals($this->container->count(), 2);
    $this->assertEquals($this->container[0], $val);
    $this->assertEquals("{$val}foo", $this->container->getHtml());
  }

  /**
   * 
   * @dataProvider contentData
   * @param mixed $val
   */
  public function testOffsetSet($val) {
    $container = new PlainContainer();
    $container->append("foo");
    $container[] = $val;
    $container["a"] = $val;
    $this->assertTrue($container->offsetExists(0));
    $this->assertTrue($container->offsetExists(1));
    $this->assertTrue($container->offsetExists("a"));
    $this->assertEquals($container->count(), 3);
    $this->assertEquals($container[1], $val);
    $this->assertEquals($container["a"], $val);
  }

  public function arrayData(): iterable {
    yield [range("a", "e")];
    yield [array_fill(0, 3, new PlainContainer())];
    yield [range(1, 5)];
  }

  /**
   * @return void
   */
  public function testClear(): void {
    $container = new PlainContainer();
    $container->appendDiv('div');
    $this->assertCount(1, $container);
    $container->clear();
    $this->assertCount(0, $container);
  }

  /**
   * 
   * @dataProvider arrayData
   * 
   * @param  array $data
   * @return void
   */
  public function testIterator(array $data): void {
    foreach ($data as $val) {
      $this->container->append($val);
    }
    $it = $this->container->getIterator();
    foreach ($it as $key => $val) {
      $this->assertEquals($this->container[$key], $val);
    }
  }

  /**
   * @dataProvider contentData
   * 
   * @param  mixed $val
   * @return void
   */
  public function testContains(mixed $val): void {
    $container = new PlainContainer();
    $container->append($val);
    $this->assertTrue($container->contains($val));
    $this->assertFalse($container->contains('foo'));
    $container->clear()->append((new PlainContainer())->append($val));
    $this->assertTrue($container->contains($val));
    $this->assertFalse($container->contains('foo'));
  }

  public function testClone(): void {
    $container = new PlainContainer();
    $span = $container->appendSpan('foo');
    $clone = clone $container;
    $this->assertEquals($clone->count(), 1);
    $this->assertEquals($container[0], $clone[0]);
    $this->assertNotSame($container[0], $clone[0]);

    $this->assertNotSame($span, $clone[0]);
  }

  public function testAppendMarkdown(): void {
    $container1 = new PlainContainer();
    $container1->append('md: ');
    $container2 = new PlainContainer();
    $container2->append('md: ');
    $mdString = Filesystem::toString('./sphp/php/tests/files/valid.md');
    $mdToHtml = ParseFactory::md()->parseFile('./sphp/php/tests/files/valid.md');
    $container1->appendMarkdown($mdString);
    $container2->appendMarkdownFile('./sphp/php/tests/files/valid.md');
    $this->assertSame($mdToHtml, $container1[1]);
    $this->assertSame($mdToHtml, $container2[1]);
    $this->assertSame('md: ' . $mdToHtml, (string) $container1);
    $this->assertSame((string) $container1, (string) $container2);
    $this->expectException(HtmlException::class);
    $container1->appendMarkdownFile('foo.md');
  }

  public function testAppendRawFile(): void {
    $container = new PlainContainer();
    $container->append('Raw: ');
    $string = Filesystem::toString('./sphp/php/tests/files/valid.md');
    $container->appendRawFile('./sphp/php/tests/files/valid.md');
    // print_r($this->appendedStrings);
    $this->assertSame('Raw: ', $container[0]);
    $this->assertSame($string, $container[1]);
    $this->assertSame('Raw: ' . $string, (string) $container);
    $this->expectException(HtmlException::class);
    $container->appendRawFile('foo.bar');
  }

  public function testAppendPhpFile(): void {
    $container1 = new PlainContainer();
    $container1->append('php: ');
    $container2 = new PlainContainer();
    $container2->append('php: ');
    // var_dump(is_file('./sphp/php/tests/files/test.php'));
    $phpExecuted = Filesystem::executePhpToString('./sphp/php/tests/files/test.php');
    $this->assertSame('foo', $phpExecuted);
    $container1->append($phpExecuted);
    $container2->appendPhpFile('./sphp/php/tests/files/test.php');
    $this->assertSame($phpExecuted, $container1[1]);
    $this->assertSame($phpExecuted, $container2[1]);
  }

  /**
   * @return void
   */
  public function testAppendInvalidPhpFileBuffers(): void {
    $start_level = ob_get_level();
    $container = new PlainContainer();
    $this->expectException(HtmlException::class);
    $container->appendPhpFile('./sphp/php/tests/files/invalid-php/invalid-syntax.php');
    $this->assertSame($start_level, ob_get_level());
  }

}
