<?php

namespace Sphp\Html\Media;

use PHPUnit\Framework\TestCase;
use Sphp\Html\Attributes\HtmlAttributeManager;

class LazyMediaSourceTraitTest extends TestCase {

  protected $mock;

  /**
   * Sets up the fixture, for example, opens a network connection.
   * This method is called before a test is executed.
   */
  protected function setUp(): void {
    $this->mock = $this->getMockForTrait(LazyMediaSourceTrait::class);
    $mngr = new HtmlAttributeManager();
    $this->mock->expects($this->any())
            ->method('attributes')
            ->will($this->returnValue($mngr));
  }

  public function testConcreteMethod() {
    $this->assertFalse($this->mock->isLazy());
    $this->mock->setSrc('foo');
    $this->mock->setLazy(true);
    //print_r($this->mock->attributes()->toArray());
    $this->assertTrue($this->mock->setLazy(true)->isLazy());
    $this->srcSettingAndGetting('foo/bar');
    $this->assertFalse($this->mock->setLazy(false)->isLazy());
    $this->srcSettingAndGetting('foo/bar');
  }

  protected function srcSettingAndGetting(string $src) {
    $this->assertSame($this->mock, $this->mock->setSrc($src));
    if ($this->mock->isLazy()) {
      $this->assertSame($src, $this->mock->attributes()->getValue('data-src'));
      $this->assertSame($src, $this->mock->getSrc());
      $this->assertFalse($this->mock->attributes()->isVisible('src'));
    } else {
      $this->assertSame($src, $this->mock->attributes()->getValue('src'));
      $this->assertSame($src, $this->mock->getSrc());
      $this->assertSame(false, $this->mock->attributes()->getValue('data-src'));
    }
  }

}
