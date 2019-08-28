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
use Sphp\Html\Media\Icons\AbstractIconTag;
use Sphp\Html\Attributes\HtmlAttributeManager;

/**
 * Description of AbstractIconTagTest
 *
 * @author  Sami Holck <sami.holck@gmail.com>
 * @license https://opensource.org/licenses/MIT MIT License
 * @link    https://github.com/samhol/SPHP-framework Github repository
 * @filesource
 */
class AbstractIconTagTest extends TestCase {

  /**
   * @return AbstractIconTag
   */
  public function testConstructor(): AbstractIconTag {
    $attributeManager = new HtmlAttributeManager();
    $icon = $this->getMockForAbstractClass(AbstractIconTag::class, ['i', $attributeManager]);
    $this->assertSame($attributeManager, $icon->attributes());
    $this->assertSame('i', $icon->getTagName());
    return $icon;
  }

  /**
   * @depends testConstructor
   * @param   AbstractIconTag $icon
   * @return  AbstractIconTag
   */
  public function testSetDecorative(AbstractIconTag $icon):AbstractIconTag {
    $this->assertFalse($icon->attributeExists('aria-hidden'));
    $this->assertSame($icon, $icon->setDecorative(true));
    $this->assertSame('true', $icon->getAttribute('aria-hidden'));
    $this->assertSame($icon, $icon->setDecorative(false));
    $this->assertFalse($icon->attributeExists('aria-hidden'));
    return $icon;
  }

  /**
   * @depends testConstructor
   * @param   AbstractIconTag $icon
   * @return  AbstractIconTag
   */
  public function testSetAriaLabel(AbstractIconTag $icon):AbstractIconTag {
    $this->assertFalse($icon->attributeExists('aria-hidden'));
    $this->assertFalse($icon->attributeExists('aria-label'));
    $this->assertSame($icon, $icon->setTitle('foo'));
    $this->assertSame('foo', $icon->getAttribute('aria-label'));
    $this->assertSame($icon, $icon->setDecorative(true));
    $this->assertFalse($icon->attributeExists('aria-label'));
    $this->assertSame($icon, $icon->setTitle('foo-bar'));
    $this->assertSame('foo-bar', $icon->getAttribute('aria-label'));
    $this->assertSame($icon, $icon->setTitle(null));
    $this->assertFalse($icon->attributeExists('aria-label'));
    return $icon;
  }

}
