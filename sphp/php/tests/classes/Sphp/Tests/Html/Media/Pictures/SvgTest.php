<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Pictures;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Pictures\Svg;

/**
 * Description of SvgTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SvgTest extends TestCase {

  public function testFromFile(): Svg {

    $svg = Svg::fromFile('./sphp/php/tests/files/gnu.svg');
    $this->assertCount(1, $svg->getDoc()->getElementsByTagName('svg'));
    $doc = new \DOMDocument();
    $doc->load('./sphp/php/tests/files/gnu.svg');
    $expected = $doc->saveHTML($doc->getElementsByTagName('svg')->item(0));
    $this->assertEquals($expected, (string) $svg);
    return $svg;
  }

  /**
   * @depends testFromFile
   * 
   * @param  Svg $svg
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
   * @depends testFromFile
   * 
   * @param  Svg $svg
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
   * @depends testFromFile
   * 
   * @param  Svg $svg
   * @return void
   */
  public function testSetOpacity(Svg $svg): void {
    $this->assertSame($svg, $svg->setOpacity(0.5));
    $this->assertEquals('0.5', $svg->getSvg()->getAttribute('opacity'));
    $this->assertSame($svg, $svg->setOpacity(null));
    $this->assertEquals('', $svg->getSvg()->getAttribute('opacity'));
  }

}
