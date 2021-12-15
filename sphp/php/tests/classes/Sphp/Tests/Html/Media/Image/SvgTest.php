<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Image;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Image\SvgLoader;
use Sphp\Html\Media\Image\Svg;

/**
 * Description of SvgTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class SvgTest extends TestCase {

  /**
   * @var SvgLoader
   */
  private $loader;

  protected function setUp(): void {
    parent::setUp();
    $this->loader = new SvgLoader();
  }

  public function testCreating(): Svg {

    $svg = $this->loader->fileToObject('./sphp/php/tests/files/human-skull.svg');
    $this->assertCount(1, $svg->getDoc()->getElementsByTagName('svg'));
    $doc = new \DOMDocument();
    $doc->load('./sphp/php/tests/files/human-skull.svg');
    $expected = $doc->saveHTML($doc->getElementsByTagName('svg')->item(0));
    $this->assertEquals($expected, (string) $svg);
    return $svg;
  }

  /**
   * @depends testCreating
   * @param Svg $svg
   */
  public function testSetTitle(Svg $svg) {
    $this->assertSame($svg, $svg->setTitle('foo'));
    $this->assertCount(1, $svg->getSvg()->getElementsByTagName('title'));
    $this->assertSame($svg, $svg->setTitle('bar'));
    $this->assertCount(1, $svg->getSvg()->getElementsByTagName('title'));
    $this->assertSame($svg, $svg->setTitle(null));
    $this->assertCount(0, $svg->getSvg()->getElementsByTagName('title'));
  }

  /**
   * @depends testCreating
   * @param Svg $svg
   */
  public function testSetDimension(Svg $svg) {
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
   * @param Svg $svg
   */
  public function testSetOpacity(Svg $svg) {
    $this->assertSame($svg, $svg->setOpacity(0.5));
    $this->assertEquals('0.5', $svg->getSvg()->getAttribute('opacity'));
    $this->assertSame($svg, $svg->setOpacity(null));
    $this->assertEquals('', $svg->getSvg()->getAttribute('opacity'));
  }

}
