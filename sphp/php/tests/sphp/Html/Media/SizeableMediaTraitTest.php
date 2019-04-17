<?php

namespace Sphp\Html\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\HtmlAttributeManager;

class SizeableMediaTraitTest extends TestCase {

  protected $component;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->component = $this->getMockForTrait(SizeableMediaTrait::class);
    $mngr = new HtmlAttributeManager();
    $this->component->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
  }

  public function testWidthAndHeightSetting() {
    $this->assertSame($this->component, $this->component->setWidth(100));
    $this->assertSame(100, $this->component->attributes()->getValue('width'));
    $this->assertSame($this->component, $this->component->setHeight(200));
    $this->assertSame(200, $this->component->attributes()->getValue('height'));
  }

}
