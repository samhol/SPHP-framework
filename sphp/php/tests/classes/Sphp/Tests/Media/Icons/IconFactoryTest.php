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
use Sphp\Media\Icons\IconFactory;

/**
 * Description of DeviconsTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IconFactoryTest extends TestCase {

  /**
   * @return IconFactory
   */
  public function testConstructor(): IconFactory {
    $factory = new IconFactory('i');
    $icon = $factory('devicon-github-plain');
    $this->assertTrue($icon->createTag()->hasCssClass('devicon-github-plain'));
    $this->assertSame('i', $icon->createTag()->getTagName()); 
    return $factory;
  }
 

  /**
   * @return DevIcons
   */
  public function testMagicInvoke(): IconFactory {
    $factory = new IconFactory('i');
    $icon = $factory('devicon-github-plain');
    $this->assertTrue($icon->createTag()->hasCssClass('devicon-github-plain'));
    $this->assertSame('i', $icon->createTag()->getTagName());
    return $factory;
  }
 

  /**
   * @return DevIcons
   */
  public function testCallStatic(): IconFactory {
    $factory = new IconFactory();
    $icon = IconFactory::get('devicon-github-plain');
    $this->assertTrue($icon->createTag()->hasCssClass('devicon-github-plain'));
    $this->assertSame('i', $icon->createTag()->getTagName());
    return $factory;
  }

  /**
   * @depends testConstructor
   * @param   DevIcons $icon
   */
  public function testClone(IconFactory $icon) {
    $cloned = clone $icon;
    $this->assertNotSame($icon, $cloned);
    $this->assertEquals($icon('fas fa-tree'), $cloned('fas fa-tree'));
  }

}
