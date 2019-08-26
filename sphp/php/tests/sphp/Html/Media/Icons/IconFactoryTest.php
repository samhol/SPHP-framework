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
use Sphp\Html\Media\Icons\IconFactory;

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
    $i = $factory('devicon-github-plain');
    $this->assertTrue($i->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('i', $i->getTagName());
    $span = $factory->span('devicon-github-plain');
    $this->assertTrue($span->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('span', $span->getTagName());
    return $factory;
  }

  /**
   * @depends testConstructor
   * 
   * @param IconFactory $factory
   * @return IconFactory
   */
  public function testIconAttributes(IconFactory $factory): IconFactory {
    $factory->setIconAttribute('data-foo', 'bar');
    $i = $factory('devicon-github-plain');
    $this->assertTrue($i->attributeExists('data-foo'));
    $this->assertEquals('bar', $i->getAttribute('data-foo'));
    return $factory;
  }

  /**
   * @return DevIcons
   */
  public function testMagicInvoke(): IconFactory {
    $factory = new IconFactory('i');
    $icon = $factory('devicon-github-plain');
    $this->assertTrue($icon->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('i', $icon->getTagName());
    return $factory;
  }

  public function iconData(): array {
    $data = [];
    $data[] = ['i', 'fas fa-tree'];
    $data[] = ['span', 'devicon-github-plain'];
    return $data;
  }

  /**
   * @dataProvider iconData
   * @return IconFactory
   */
  public function testMagicCall(string $methodName, string $iconName): IconFactory {
    $factory = new IconFactory();
    $icon = $factory->$methodName($iconName);
    $this->assertTrue($icon->cssClasses()->contains($iconName));
    $this->assertSame($methodName, $icon->getTagName());
    return $factory;
  }

  /**
   * @return DevIcons
   */
  public function testCallStatic(): IconFactory {
    $factory = new IconFactory();
    $icon = IconFactory::i('devicon-github-plain');
    $this->assertTrue($icon->cssClasses()->contains('devicon-github-plain'));
    $this->assertSame('i', $icon->getTagName());
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
