<?php

/**
 * SPHPlayground Framework (https://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Media\Icons\FontAwesomeIcon;

/**
 * Implementation of FontAwesomeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FontAwesomeIconTest1 extends TestCase {

  /**
   * @return FontAwesomeIcon
   */
  public function testConstructor(): FontAwesomeIcon {
    $icon = new FontAwesomeIcon('fas fa-tree', 'foo bar');
    $this->assertTrue($icon->createTag()->hasCssClass('fas fa-tree'));
    $this->assertSame('i', $icon->createTag()->getTagName());
    return $icon;
  }

  /**
   * @depends testConstructor
   * @param   FontAwesomeIcon $icon
   * @return  FontAwesomeIcon
   */
  public function testSetFixedWidth(FontAwesomeIcon $icon): FontAwesomeIcon {
    $this->assertFalse($icon->createTag()->hasCssClass('fa-fw'));
    $this->assertSame($icon, $icon->fixedWidth(true));
    $this->assertTrue($icon->createTag()->hasCssClass('fa-fw'));
    $this->assertSame($icon, $icon->fixedWidth(false));
    $this->assertFalse($icon->createTag()->hasCssClass('fa-fw'));
    return $icon;
  }

  /**
   * @depends testConstructor
   * @param   FontAwesomeIcon $icon
   * @return  FontAwesomeIcon
   */
  public function testPull(FontAwesomeIcon $icon): FontAwesomeIcon {
    $this->assertFalse($icon->createTag()->hasCssClass('fa-pull-left', 'fa-pull-right'));
    $this->assertSame($icon, $icon->pull('left'));
    $this->assertTrue($icon->createTag()->hasCssClass('fa-pull-left'));
    $this->assertFalse($icon->createTag()->hasCssClass('fa-pull-right'));
    $this->assertSame($icon, $icon->pull('right'));
    $this->assertTrue($icon->createTag()->hasCssClass('fa-pull-right'));
    $this->assertFalse($icon->createTag()->hasCssClass('fa-pull-left'));
    $this->assertSame($icon, $icon->pull(null));
    $this->assertFalse($icon->createTag()->hasCssClass('fa-pull-left', 'fa-pull-right'));
    return $icon;
  }

  public function iconSizes(): array {
    $sizes = [];
    $sizes[] = ['xs'];
    $sizes[] = ['sm'];
    $sizes[] = ['lg'];
    $sizes[] = ['2x'];
    $sizes[] = ['3x'];
    $sizes[] = ['5x'];
    $sizes[] = ['7x'];
    $sizes[] = ['10x'];
    return $sizes;
  }

  /**
   * @dataProvider iconSizes 
   * @param   string $size
   */
  public function testSetSize(string $size): void {
    $icon = new FontAwesomeIcon('fas fa-tree', 'foo bar');
    $this->assertFalse($icon->createTag()->hasCssClass("fa-$size"));
    $this->assertSame($icon, $icon->setSize("fa-$size"));
    $this->assertTrue($icon->createTag()->hasCssClass("fa-$size"));
    $this->assertSame($icon, $icon->setSize(null));
    $this->assertFalse($icon->createTag()->hasCssClass("fa-$size"));
    $this->assertSame($icon, $icon->setSize($size));
    $this->assertTrue($icon->createTag()->hasCssClass("fa-$size"));
    $this->assertSame($icon, $icon->setSize(null));
    $this->assertFalse($icon->createTag()->hasCssClass("fa-$size"));
  }

  /**
   * @depends testConstructor
   * @param   FontAwesomeIcon $icon
   */
  public function testClone(FontAwesomeIcon $icon) {
    $cloned = clone $icon;
    $this->assertNotSame($icon, $cloned);
    $this->assertSame($icon->getHtml(), $cloned->getHtml());
  }

}
