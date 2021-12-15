<?php

declare(strict_types=1);

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2020 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html;

use PHPUnit\Framework\TestCase;
use Sphp\Html\PlainContainer;
use Sphp\Html\Span;
use Sphp\Html\Div;
use Sphp\Stdlib\Parsers\ParseFactory;
use Sphp\Html\Exceptions\HtmlException;

/**
 * Class IteratorTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class PlainContainerTest extends TestCase {

  use TraversableContentTestTrait,
      ContainerTestTrait,
      \Sphp\Tests\ArrayAccessTestTrait;

  /**
   * @return array
   */
  public function iteratorData(): array {
    $range = range('a', 'c');
    $data = [];
    $data[] = [$range];
    $data[] = [[]];
    $data[] = [1];
    $data[] = ['1'];
    $data[] = [[new \Sphp\Html\Span('foo')]];
    $data[] = [new \ArrayIterator($range)];
    return $data;
  }

  /**
   * @dataProvider iteratorData
   * 
   * @param  iterable $data
   * @return void
   */
  public function testConstructor($data): void {
    $container = new PlainContainer($data);
    //$this->assertTrue($it->valid());
    if ($data instanceof \Traversable) {
      $data = iterator_to_array($data);
    }
    if (!is_array($data)) {
      $data = [$data];
    }
    $this->assertCount(count($data), $container);
    foreach ($container as $key => $value) {
      $this->assertSame($value, $data[$key]);
    }
    $toArray = $container->toArray();
    $this->assertEquals($toArray, $data);
    $this->assertSame(implode('', $data), $container->getHtml());
    $this->assertSame(implode('', $container->toArray()), $container->getHtml());
  }

  /**
   * @dataProvider iteratorData
   * 
   * @param  iterable $data
   * @return void
   */
  public function testClone($data): void {
    $it = new PlainContainer($data);
    $clone = clone $it;
    //$this->assertTrue($it->valid());
    // $this->assertContainsEquals($clone, $it);
    $this->assertCount(count($it), $clone);
    foreach ($it as $key => $value) {
      if (is_object($value)) {
        $this->assertEquals($value, $clone[$key]);
        $this->assertNotSame($value, $clone[$key]);
      } else {
        $this->assertSame($value, $clone[$key]);
      }
    }
    $this->assertSame($clone->getHtml(), $it->getHtml());
  }

  public function mixedData(): array {
    $data = [];
    $data[2] = new Span('foo');
    $data[1] = $div = new Div('foo');
    $data[0] = new Div($div);
    $data[] = 'string';
    $data[] = '';
    $data[] = null;
    $data['two'] = 2;
    $data[] = 0;
    $data[] = false;
    $data[] = true;
    return $data;
  }

  public function testContentOrder(): void {
    $data[3] = 'c';
    $data[2] = 'b';
    $data[1] = 'a';
    $it = new PlainContainer($data);
    ksort($data);
    $sorted = new PlainContainer($data);
    $this->assertSame('cba', $it->getHtml());
    $this->assertSame('abc', $sorted->getHtml());
    $this->assertNotEquals($sorted->getHtml(), $it->getHtml());
  }

  public function testAppendMarkdown(): void {
    $container1 = new PlainContainer();
    $container1->append('md: ');
    $container2 = new PlainContainer();
    $container2->append('md: ');
    $mdString = \Sphp\Stdlib\Filesystem::toString('./sphp/php/tests/files/valid.md');
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

  public function testAppendPhpFileBuffers(): void {
    $start_level = ob_get_level();
    $container1 = new PlainContainer();
    $container1->appendPhpFile('./sphp/php/tests/files/test.php');
    $this->assertSame($start_level, ob_get_level());
  }

  public function testAppendPhpFile(): void {
    $container1 = new PlainContainer();
    $container1->append('php: ');
    $container2 = new PlainContainer();
    $container2->append('php: ');
   // var_dump(is_file('./sphp/php/tests/files/test.php'));
    $phpExecuted = \Sphp\Stdlib\Filesystem::executePhpToString('./sphp/php/tests/files/test.php');
    $this->assertSame('foo', $phpExecuted);
    $container1->append($phpExecuted);
    $container2->appendPhpFile('./sphp/php/tests/files/test.php');
    $this->assertSame($phpExecuted, $container1[1]);
    $this->assertSame($phpExecuted, $container2[1]);
  }

  public function invalidPHPFiles(): iterable {
    yield ['./sphp/php/tests/files/invalid-php/invalid-syntax.php'];
   // yield ['./sphp/php/tests/files/invalid-php/throws.php'];
  }

  /**
   * @dataProvider invalidPHPFiles
   * 
   * @param  string $filePath
   * @return void
   */
  public function testAppendInvalidPhpFileBuffers(string $filePath): void {
    $start_level = ob_get_level();
    $container = new PlainContainer();
    $this->expectException(HtmlException::class);
    $container->appendPhpFile($filePath);
    //$this->assertSame($start_level, ob_get_level());
  }

  public function testAppendRawFile(): void {
    $container = new PlainContainer();
    $container->append('Raw: ');
    $string = \Sphp\Stdlib\Filesystem::toString('./sphp/php/tests/files/valid.md');
    $container->appendRawFile('./sphp/php/tests/files/valid.md');
    // print_r($this->appendedStrings);
    $this->assertSame('Raw: ', $container[0]);
    $this->assertSame($string, $container[1]);
    $this->assertSame('Raw: ' . $string, (string) $container);
    $this->expectException(HtmlException::class);
    $container->appendRawFile('foo.bar');
  }

  public function create(iterable $content): PlainContainer {
    return new PlainContainer($content);
  }

  public function containerData(): array {
    return $this->mixedData();
  }

  public function createEmptyContainer(): PlainContainer {
    return new PlainContainer();
  }

  public function createArrayAccessObject(): PlainContainer {
    return new PlainContainer();
  }

  public function arrayAccessTestData(): array {
    return $this->mixedData();
  }

}
