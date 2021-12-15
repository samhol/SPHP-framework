<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Media\SVG;

use PHPUnit\Framework\TestCase;
use Sphp\Media\SVG\Svg;
use Sphp\Exceptions\FileSystemException;
use Sphp\Exceptions\InvalidArgumentException;

/**
 * Description of SvgTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SvgTest extends TestCase {

  public function testCreating(): Svg {

    $svg = Svg::fileToObject('./sphp/php/tests/files/valid.svg');
    $this->assertCount(1, $svg->getDoc()->getElementsByTagName('svg'));
    $doc = new \DOMDocument();
    $doc->load('./sphp/php/tests/files/valid.svg');
    $expected = $doc->saveHTML($doc->getElementsByTagName('svg')->item(0));
    $this->assertEquals($expected, (string) $svg);
    return $svg;
  }

  /**
   * @depends testCreating
   *  
   * @param Svg $svg
   * @return void
   */
  public function testSetTitle(Svg $svg): void {
    $this->assertSame($svg, $svg->setTitle('foo'));
    $this->assertCount(1, $svg->getSvg()->getElementsByTagName('title'));
    $this->assertSame($svg, $svg->setTitle('bar'));
    $this->assertCount(1, $svg->getSvg()->getElementsByTagName('title'));
    $this->assertSame($svg, $svg->setTitle(null));
    $this->assertCount(0, $svg->getSvg()->getElementsByTagName('title'));
  }

  /**
   * @depends testCreating
   *  
   * @param Svg $svg
   * @return void
   */
  public function testSetColor(Svg $svg): void {
    $this->assertSame($svg, $svg->setColor('red'));
    foreach ($svg->getSvg()->getElementsByTagName('g') as $g) {
      $this->assertSame('red', $g->getAttribute('fill'));
    }
    $this->assertSame($svg, $svg->setColor('#fff'));
    foreach ($svg->getSvg()->getElementsByTagName('g') as $g) {
      $this->assertSame('#fff', $g->getAttribute('fill'));
    }
  }

  /**
   * @depends testCreating
   *  
   * @param Svg $svg
   * @return void
   */
  public function testSetStroke(Svg $svg): void {
    $this->assertSame($svg, $svg->setStroke('red', .2));
    foreach ($svg->getSvg()->getElementsByTagName('g') as $g) {
      $this->assertSame('red', $g->getAttribute('stroke'));
      $this->assertSame('0.2', $g->getAttribute('stroke-width'));
    }
    $this->assertSame($svg, $svg->setStroke('#fff', .1));
    foreach ($svg->getSvg()->getElementsByTagName('g') as $g) {
      $this->assertSame('#fff', $g->getAttribute('stroke'));
      $this->assertSame('0.1', $g->getAttribute('stroke-width'));
    }
  }

  /**
   * @depends testCreating
   *  
   * @param Svg $svg
   * @return void
   */
  public function testSetDimension(Svg $svg): void {
    $this->assertSame($svg, $svg->setWidth(10.5));
    $this->assertEquals('10.5px', $svg->getSvg()->getAttribute('width'));
    $this->assertSame($svg, $svg->setWidth(null));
    $this->assertEquals('', $svg->getSvg()->getAttribute('width'));
    $this->assertSame($svg, $svg->setWidth('10%'));
    $this->assertEquals('10%', $svg->getSvg()->getAttribute('width'));

    $this->assertSame($svg, $svg->setHeight(10.5));
    $this->assertEquals('10.5px', $svg->getSvg()->getAttribute('height'));
    $this->assertSame($svg, $svg->setHeight(null));
    $this->assertEquals('', $svg->getSvg()->getAttribute('height'));
    $this->assertSame($svg, $svg->setHeight('10%'));
    $this->assertEquals('10%', $svg->getSvg()->getAttribute('height'));
  }

  /**
   * @depends testCreating
   *  
   * @param Svg $svg
   * @return void
   */
  public function testSetOpacity(Svg $svg): void {
    $this->assertSame($svg, $svg->setOpacity(0.5));
    $this->assertEquals('0.5', $svg->getSvg()->getAttribute('opacity'));
    $this->assertSame($svg, $svg->setOpacity(null));
    $this->assertEquals('', $svg->getSvg()->getAttribute('opacity'));
  }

  public function testLoadingLocalFile(): void {
    $path = './sphp/php/tests/files/valid.svg';
    $data = file_get_contents($path, false);
    $svgFromFile = Svg::fileToObject($path);
    $svgFromString = Svg::stringToSvg($data);
    $this->assertEquals($svgFromFile, $svgFromString);
  }

  public function noFileProvider(): iterable {
    yield ['', FileSystemException::class];
    yield ['foo.svg', FileSystemException::class];
    yield ['./sphp/php/tests/files/rss.xml', InvalidArgumentException::class];
    yield ['./sphp/php/tests/files/invalid.svg', InvalidArgumentException::class];
  }

  /**
   * @dataProvider noFileProvider
   * 
   * @param  string $path
   * @param  string $exceptionType
   * @return void
   */
  public function testInvalidLocalFile(string $path, string $exceptionType): void {
    $this->expectException($exceptionType);
    Svg::fileToObject($path);
  }

  /**
   * @return void
   */
  public function testInvalidStrings(): void {
    $this->expectException(InvalidArgumentException::class);
    Svg::stringToSvg('<svg></s>');
  }

}
