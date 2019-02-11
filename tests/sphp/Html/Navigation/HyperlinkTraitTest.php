<?php

/**
 * SPHPlayground Framework (http://playgound.samiholck.com/)
 *
 * @link      https://github.com/samhol/SPHP-framework for the source repository
 * @copyright Copyright (c) 2007-2018 Sami Holck <sami.holck@gmail.com>
 * @license   https://opensource.org/licenses/MIT The MIT License
 */

namespace Sphp\Html\Navigation;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\HtmlAttributeManager;

class HyperlinkTraitTest extends TestCase {

  /**
   * @var HyperlinkTrait 
   */
  protected $mock;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->mock = $this->getMockForTrait(HyperlinkTrait::class);
    $mngr = new HtmlAttributeManager();
    $this->mock->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
  }

  public function testSettingAndGetting() {
    $this->assertSame($this->mock, $this->mock->setHref('foo.html'));
    $this->assertSame('foo.html', $this->mock->attributes()->getValue('href'));
    $this->assertSame('foo.html', $this->mock->getHref());
    $this->assertSame($this->mock, $this->mock->setTarget('foo'));
    $this->assertSame('foo', $this->mock->attributes()->getValue('target'));
    $this->assertSame('foo', $this->mock->getTarget());
    $this->assertSame($this->mock, $this->mock->setRelationship('help'));
    $this->assertSame('help', $this->mock->attributes()->getValue('rel'));
    $this->assertSame('help', $this->mock->getRelationship());
  }

  public function testBlankTarget() {
    $this->assertSame($this->mock, $this->mock->setTarget('_blank'));
    $this->assertSame('noopener noreferrer', $this->mock->getRelationship());
  }

}
