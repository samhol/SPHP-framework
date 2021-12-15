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
use Sphp\Media\Icons\FontAwesome;
use Sphp\Media\Icons\FontAwesomeIcon;

/**
 * Implementation of FontAwesomeTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT The MIT License
 * @link    https://github.com/samhol/SPHP-framework GitHub repository
 * @filesource
 */
class FontAwesomeTest extends TestCase {

  /**
   * @return FontAwesome
   */
  public function testInvoking(): FontAwesome {
    $factory = new FontAwesome();
    $icon = $factory('fas fa-tree');
    $i = $icon->createTag();
    $this->assertTrue($i->hasCssClass('fas fa-tree'));
    $this->assertSame('i', $i->getTagName());
    return $factory;
  }

  /**
   * @depends testInvoking
   * @param   FontAwesome $factory
   * @return  FontAwesome
   */
  public function testSetFixedWidth(FontAwesome $factory): FontAwesome {
    $this->assertFalse($factory('fas fa-tree')->createTag()->hasCssClass('fa-fw'));
    $this->assertSame($factory, $factory->fixedWidth(true));
    $icon = $factory('fas fa-tree');
    $this->assertTrue($icon->createTag()->hasCssClass('fa-fw'));
    $this->assertSame($factory, $factory->fixedWidth(false));
    $this->assertFalse($factory('fas fa-tree')->createTag()->hasCssClass('fa-fw'));
    return $factory;
  }

  /**
   * @depends testInvoking
   * @param   FontAwesome $factory
   * @return  FontAwesome
   */
  public function testUseBorders(FontAwesome $factory): FontAwesome {
    $this->assertFalse($factory('fas fa-tree')->createTag()->hasCssClass('fa-border'));
    $this->assertSame($factory, $factory->useBorders(true));
    $this->assertTrue($factory('fas fa-tree')->createTag()->hasCssClass('fa-border'));
    $this->assertSame($factory, $factory->useBorders(false));
    $this->assertFalse($factory('fas fa-tree')->createTag()->hasCssClass('fa-border'));
    return $factory;
  }

  /**
   * @depends testSetFixedWidth
   * @param   FontAwesome $factory
   * @return  FontAwesomeIcon
   */
  public function testPull(FontAwesome $factory): FontAwesomeIcon {
    $this->assertSame($factory, $factory->pull('left'));
    $pullLeft = $factory('fas fa-tree');
    $this->assertTrue($pullLeft->createTag()->hasCssClass('fa-pull-left'));
    $this->assertFalse($pullLeft->createTag()->hasCssClass('fa-pull-right'));
    $this->assertFalse($pullLeft->createTag()->hasCssClass('fa-pull-right'));
    $this->assertSame($factory, $factory->pull('right'));
    $pullRight = $factory('fas fa-tree');
    $this->assertTrue($pullRight->createTag()->hasCssClass('fa-pull-right'));
    $this->assertFalse($pullRight->createTag()->hasCssClass('fa-pull-left'));
    $this->assertSame($factory, $factory->pull(null));
    $icon = $factory('fas fa-tree');
    $this->assertFalse($icon->createTag()->hasCssClass('fa-pull-left fa-pull-right'));
    return $icon;
  }

  public function iconSizes(): iterable {
    yield ['xs'];
    yield ['sm'];
    yield ['lg'];
    yield ['2x'];
    yield ['3x'];
    yield ['5x'];
    yield ['7x'];
    yield['10x'];
  }

  /**
   * @dataProvider iconSizes 
   * 
   * @param  string $size
   * @return void
   */
  public function testSetSize(string $size): void {
    $factory = new FontAwesome();
    $this->assertSame($factory, $factory->setSize($size));
    $sizedIcon = $factory('fas fa-tree');
    $i = $sizedIcon->createTag();
    $this->assertTrue($i->hasCssClass("fa-$size"));
    $this->assertSame($factory, $factory->setSize(null));
    $icon = $factory('fas fa-tree');
    $i1 = $icon->createTag();
    $this->assertFalse($i1->hasCssClass("fa-$size"));
  }

  /**
   * @depends testInvoking
   * 
   * @param  FontAwesome $icon
   * @return void
   */
  public function testClone(FontAwesome $icon): void {
    $cloned = clone $icon;
    $this->assertNotSame($icon, $cloned);
    $this->assertEquals($icon('fas fa-tree'), $cloned('fas fa-tree'));
  }

}
