<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Media\ImageMap;

use PHPUnit\Framework\TestCase;

class AbstractAreaTest1 extends TestCase {

  public function createArea(string $shape, string $href = null, string $alt = null): AbstractArea {
    $area = $this->getMockBuilder(AbstractArea::class)
            ->setMethods()
            ->setConstructorArgs([$shape, $href, $alt])
            ->enableOriginalConstructor()
            ->getMock();
    $this->assertEquals($shape, $area->getShape());
    if ($href !== null) {
      $this->assertEquals($href, $area->getHref());
    }
    if ($alt !== null) {
      $this->assertEquals($alt, $area->getAlt());
    }
    return $area;
  }

  public function testDefault(): AbstractArea {
    $area = $this->createArea('default', 'foo/bar', 'Foo Bar');
    $area->getCoordinates()->setValue(1, 3);
    $this->assertEquals('1,3', $area->getCoordinates()->getValue());
    return $area;
  }

  /**
   * @depends testDefault
   * @param AbstractArea $area
   */
  public function testAlt(AbstractArea $area) {
    $this->assertSame($area, $area->setAlt('Alternative text'));
    $this->assertEquals('Alternative text', $area->getAlt());
  }

}
