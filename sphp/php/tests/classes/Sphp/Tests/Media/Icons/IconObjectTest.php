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
use Sphp\Media\Icons\IconObject;

/**
 * Description of IconTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class IconObjectTest extends TestCase {

  public function testConstructor(): IconObject {
    $icon = new IconObject('devicon-github-plain');
    $i = $icon->createTag();
    $this->assertTrue($i->cssClasses()->contains('devicon-github-plain'));
    $this->assertFalse($i->attributeExists('aria-hidden'));
    $this->assertFalse($i->attributeExists('title'));
    $this->assertSame('i', $i->getTagName());
    return $icon;
  }

  /**
   * @depends testConstructor
   * 
   * @param IconObject $icon
   */
  public function testSetTitle(IconObject $icon) {
    $icon->setTitle('foobar');
    $i = $icon->createTag();
    $this->assertSame('foobar', $i->getAttribute('title'));
  }

  /**
   * @depends testConstructor
   * 
   * @param IconObject $icon
   */
  public function testSetDecorative(IconObject $icon) {
    $icon->setDecorative(true);
    $i = $icon->createTag();
    $this->assertSame('true', $i->getAttribute('aria-hidden'));
    $this->assertFalse($i->attributeExists('aria-label'));
  }

}
