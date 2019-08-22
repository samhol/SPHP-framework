<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2019 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Tests\Html\Media\Icons;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Media\Icons\FontAwesome;
use Sphp\Html\Media\Icons\FontAwesomeIcon;

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
    $this->assertTrue($icon->cssClasses()->contains('fas fa-tree'));
    $this->assertSame('i', $icon->getTagName());
    $this->assertFalse($icon->cssClasses()->contains('fa-fw'));
    $this->assertFalse($icon->cssClasses()->contains('fa-pull-left', 'fa-pull-right'));
    return $factory;
  }

  /**
   * @depends testInvoking
   * @param   FontAwesome $factory
   * @return  FontAwesome
   */
  public function testSetFixedWidth(FontAwesome $factory): FontAwesome {
    $factory->fixedWidth(true);
    $icon = $factory('fas fa-tree');
    $this->assertTrue($icon->cssClasses()->contains('fa-fw'));
    return $factory;
  }

  /**
   * @depends testSetFixedWidth
   * @param   FontAwesome $factory
   * @return  FontAwesomeIcon
   */
  public function testPull(FontAwesome $factory): FontAwesomeIcon {
    $this->assertSame($factory, $factory->pull('left'));
    $iconPulledLeft = $factory('fas fa-tree');
    $this->assertTrue($iconPulledLeft->cssClasses()->contains('fa-pull-left'));
    $this->assertFalse($iconPulledLeft->cssClasses()->contains('fa-pull-right'));
    $this->assertSame($factory, $factory->pull('right'));
    $iconPulledRight = $factory('fas fa-tree');
    $this->assertTrue($iconPulledRight->cssClasses()->contains('fa-pull-right'));
    $this->assertFalse($iconPulledRight->cssClasses()->contains('fa-pull-left'));
    $this->assertSame($factory, $factory->pull(null));
    $icon = $factory('fas fa-tree');
    $this->assertFalse($icon->cssClasses()->contains('fa-pull-left', 'fa-pull-right'));
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
    $factory = new FontAwesome();
    $this->assertSame($factory, $factory->setSize($size));
    $sizedIcon = $factory('fas fa-tree');
    $this->assertTrue($sizedIcon->cssClasses()->contains("fa-$size"));
    $this->assertSame($factory, $factory->setSize(null));
    $icon = $factory('fas fa-tree');
    $this->assertFalse($icon->cssClasses()->contains("fa-$size"));   
    $this->assertSame($factory, $factory->setSize("fa-$size"));
    $sizedIcon1 = $factory('fas fa-tree');
    $this->assertTrue($sizedIcon1->cssClasses()->contains("fa-$size"));
  }

  /**
   * @depends testInvoking
   * @param   FontAwesomeIcon $icon
   */
  public function testClone(FontAwesome $icon) {
    $cloned = clone $icon;
    $this->assertNotSame($icon, $cloned);
    $this->assertEquals($icon('fas fa-tree'), $cloned('fas fa-tree'));
  }

}
